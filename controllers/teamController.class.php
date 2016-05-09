<?php 
/*

    Les controlleurs sont des extensions de la classe template,
    ce sont eux qui gère ce qui sera affiché sur la vue selon les infos que renverra le manager

    Le manager est une extension de la classe basesql,
    le manager et sa classe mère sont les seuls à intervenir sur la BDD, 
    au moyen de requête SQL

    L'unique manière de transférer des données entre vue <- controller - manager -> BDD
    est d'utiliser des objets correspondant à la table ciblée en base

*/
class teamController extends template{
	public function teamAction(){

        //Initialisation de la vue
		$v = new View();
        $this->assignConnectedProperties($v);
		$v->assign("css", "team");
		$v->assign("js", "team");
		$v->assign("title", "Team");
		$v->assign("content", "Fiche d'une team");

        //Si un paramètre GET portant le nom d'une team dans l'URL
        if(isset($_GET['team'])){

            /*
                Initialisation du manager qui va faire office d'intermediaire entre 
                le controlleur et la BDD
            */
            $teamBDD = new teamManager();


            /*
                Tout élèment (créé par l'utilisateur ou récupéré de la BDD) 
                sera stocké dans un objet de type Team (décrit dans team.class.php)    
            */

            //on définit la liste des $_GET autorisés dans ce tableau (ici uniquement $_GET['team'])
            $args = array('team' => FILTER_SANITIZE_STRING );

            //Array_filter se débarasse de toute valeur vide ou NULL
            $filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));
            
            //On remplace la clé "team" par "name" pour retrouver la colonne en BDD
            if(isset($filteredinputs['team'])){
                $filteredinputs['name']=$filteredinputs['team'];
                unset($filteredinputs['team']);
            }
            
            /*
                Appel de la méthode getTeam() dans TeamManager pour récupérer 
                les données d'une team en BDD ayant les même infos en commun

                La méthode getTeam() va retourner les infos dans un objet de type Team

                PS: une méthode du manager peut se trouver soit dans ce manager,
                    soit sa classe-mère basesql
            */

            $team = $teamBDD->getTeam($filteredinputs);

            // Si $team === FALSE : soit pas de team trouvée, soit pbm de requete            
            if($team!==FALSE){
                
                //On enregistre dans un tableau le nom de toutes les méthodes
                $team_methods = get_class_methods($team);

                foreach ($team_methods as $key => $method) {

                    //Ce qui nous interesse ici sont les getters
                    if(strpos($method, 'get') !== FALSE){

                        //On récupère le nom de l'attribut ciblé (ex: 'getName' devient 'name')
                        $col = lcfirst(str_replace('get', '', $method));
                        
                        //TODO : DYLAN
                       // $this->columns[$col] = $team->$method();
                        
                        /*
                            On crée une variable au nom de l'attribut 
                            avec la valeur que lui a renvoyé la BDD
                        */
                        $v->assign($col, $team->$method());
                                
                    }; // Le ; ne gêne pas, ça évite un else{} éventuel

                }

                //TODO : Apparition du bouton de configuration pour le président de la team
                // if(isset($_SESSION[COOKIE_EMAIL]) && $_SESSION[COOKIE_EMAIL]===$team->getEmail())
                //     $v->assign('myAccount', 1);
            }
            else{
                $v->assign("err", "1");
            }
        }
        else{
            $v->assign("err", "1");
        }
        $v->setView("team");
    }
    /******************* VOIR SI FONCTIONS ENCORE PERTINENTES ***************************/
    private function isFormStringValid($string, $minLen = 4, $maxLen = 25, $optionnalCharsAuthorized = ""){
        $string = trim($string);
        $string = str_replace('  ', ' ', $string);
        if(strlen($string) < $minLen || strlen($string) > $maxLen)
            return false;
        $regex = '/[^a-z_\-0-9 '. $optionnalCharsAuthorized .']/i';
        if(preg_match($regex, $string))
            return false;
        return true;
    }
    
	public function verifyAction(){
        if(!($this->connectedUser instanceof user)){
            $this->echoJSONerror("connection", "vous n'etes pas authentifie !");
        }
		$args = array(
            'name'     => FILTER_SANITIZE_STRING,    
            'slogan'     => FILTER_SANITIZE_STRING,   
    	    'description'     => FILTER_SANITIZE_STRING    
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
        // $data = [];
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				$this->echoJSONerror("inputs", "manque: ".$key);
		}
        if(!($this->isFormStringValid($filteredinputs['name'])))
            $this->echoJSONerror("name", "le nom ne respecte pas les regles");
         
        if(!($this->isFormStringValid($filteredinputs['slogan'], 10, 50, ',\?!\.\+')))
            $this->echoJSONerror("slogan", "le slogan ne respecte pas les règles");
        if(!($this->isFormStringValid($filteredinputs['description'], 10, 250, ',\?!\.\+')))
            $this->echoJSONerror("description", "la description ne respecte pas les règles");
    
        $team = new team($filteredinputs);
        $dbTeam = new teamManager();

        //Presence du nom en BDD
        if($dbTeam->isNameUsed($team))
            $this->echoJSONerror("nameused", "nom déjà utilisé");
            
        //L'user a-t-il déjà une team
        if(is_numeric($this->connectedUser->getIdTeam()))
            $this->echoJSONerror("userhasteam", "vous avez déjà une team!");
            
        //Créaton team
        $dbTeam->create($team);
        // Récupération team (avec nouvel id)
        $team = $dbTeam->getTeamFromName($team);
        unset($dbTeam);

        if(!$team)
            $this->echoJSONerror("creation", "La création de votre team a echoué");

        // MàJ de l'idTeam du user connecté
        $dbUser = new userManager();
        $dbUser->setNewTeam($this->connectedUser, $team);
        unset($dbUser);
 
        // Creation de la ligne rightsTeam
        $riTeam = new rightsteam([
            'id'=>0,
            'idUser'=>$this->connectedUser->getId(),
            'idTeam'=>$team->getId(),
            'right'=>1,
            'title'=>'maitre',
            'description'=>'Un pour les controler tous'
        ]);
        $dbRightsTeam = new rightsteamManager();
        $dbRightsTeam->create($riTeam);            
        unset($dbRightsTeam);

        echo json_encode(["success" => true]);
	}
}