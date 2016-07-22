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
		$v = new view();
        $this->assignConnectedProperties($v);
		$v->assign("css", "team");
		$v->assign("js", "team");
		$v->assign("title", "Team");
		$v->assign("content", "Liste des teams");

        

        //Liste des teams
        $obj = new teamManager();

        $listeteam = $obj->getListTeam(-1);

        //Pagination
        $pagination = $obj->getListMember(-1);
        if(!empty($pagination)){
            $v->assign("pagination", $pagination);
        }

        $v->assign("listeteam", $listeteam);
     
        $v->setView("team");

        if(isset($_SESSION['err_name'])){
            $v->assign("err_name","1");
            unset($_SESSION["err_name"]);
        }

        if(isset($_SESSION['err_desc'])){
            $v->assign("err_desc","1");
            unset($_SESSION["err_desc"]);
        }

        if(isset($_SESSION['dissoudre_team'])){
            $v->assign("dissoudre_team","1");
            unset($_SESSION["dissoudre_team"]);
        }

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
        if(!($this->isVisitorConnected()))
            $this->echoJSONerror("connection", "vous n'etes pas authentifie !");
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
        if($dbTeam->nameExists($team))
            $this->echoJSONerror("nameused", "nom déjà utilisé");
            
        //L'user a-t-il déjà une team
        if(!$this->isVisitorConnected() || !$this->connectedUser || $this->connectedUser->getIdTeam()!=NULL)
            $this->echoJSONerror("userhasteam", "vous avez déjà une team!");
            
        //Création team
        $dbTeam->mirrorObject = $team;
        $dbTeam->create();
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
        $dbRightsTeam->mirrorObject = $riTeam;
        $dbRightsTeam->create();
        unset($dbRightsTeam);

        echo json_encode(["success" => true]);
	}



    public function addTeamAction()
    {

        $args = array(
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING,
            'slogan' => FILTER_SANITIZE_STRING
        );

        $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
        if(strlen($filteredinputs['name']) < 2 || strlen($filteredinputs['name']) > 20 ||  $filteredinputs['name'] == "" ){
            $_SESSION['err_name']=$filteredinputs['name'];
        }else if(strlen($filteredinputs['description']) < 3 || strlen($filteredinputs['description']) > 20 ||  $filteredinputs['description'] == "" ){
            $_SESSION['err_desc']=$filteredinputs['description'];
            header('Location: '.WEBPATH.'/creationteam.php;');
        }

        if (isset($_FILES['img']) && $_FILES['img']['error'] != 4) {
            $uploaddir = '/web/img/upload/team/';
            $name = $_FILES['img']['name'];

            $uploadfile = getcwd().$uploaddir.$name;

            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);

            $allowed =  array('gif','png' ,'jpg', 'jpeg');
            $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
            
            if ($_FILES['img']['size'] < 1 * MB) {
                if ($_FILES['img']['error'] == 0 && in_array($ext,$allowed)){
                    if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile))
                        $filteredinputs['img'] = $name;
                }
            }
        }

        $filteredinputs['id_user_creator'] = $this->connectedUser->getId();

        $teamBDD = new teamManager();
        $teamBDD->mirrorObject = new team($filteredinputs);
        $teamBDD->create();
        $team = $teamBDD->getTeam(array('name'=>$filteredinputs['name']));
        $t = $teamBDD->SearchIdTeam($team);

        $idteam = new userManager();
        $idteam->setNewTeamId( $this->connectedUser->getId(), $t[0]["id"] );

//vérifier si la creation s'est bien passé (voir configuration de guillaume)
//si l'user co actuellement a un id team -> redirection (template ligne 40)
        header('Location: '.WEBPATH.'/detailteam?name='.$filteredinputs['name']);

    }
//$team = $teamBDD->getTeam(array('name'=>$filteredinputs['name']));

}