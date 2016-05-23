<?php
class adminController extends template{
    
    public function adminAction(){
        if($this->isVisitorConnected() && $this->isAdmin()){
            $v = new view();
    		$this->assignConnectedProperties($v);
            $v->assign("css", "admin");
                $js['admin']="admin";
                $js['platforms']="platforms";
            $v->assign("js",$js);                                       
            $v->assign("title", "admin");
            $v->assign("content", "Liste des Utilisateurs");

            $admin = new adminManager();
    		$listejoueurs = $admin->getListUser();  
            
            $platform = new platformManager();
            $listeplatforms = $platform->getListPlatform();
            
            $listesignalement = $admin->getListReports();
            
            $team = new teamManager();
            $listeteam = $team->getListTeam(-2);

            $v->assign("listejoueur",$listejoueurs);

            $v->assign("listeplatform",$listeplatforms);

            $v->assign("listesignalement",$listesignalement);

            $v->assign("listeteam",$listeteam);
           
            $v->setView("/includes/admin/accueil", "template");
        }
        else //On affiche la 404 pour faire croire que le mec tape n'importe quoi
            header('Location: '.WEBPATH.'/404');
    }

    public function getPlatformsDataAction(){
        $pm = new platformManager();
        $typesObj = $pm->getListPlatform();
        $data['res'] = [];        
        foreach ($typesObj as $key => $obj) {
            $arr = [];
            $arr['name'] = $obj->getName();
            $arr['img'] = $obj->getImg();
            $arr['description'] = $obj->getDescription();
            $data['res'][] = $arr;
        }
        echo json_encode($data['res']);
        return;
    }

    public function updatePlatformsDataAction(){
        
        
    }

    public function updateTeamStatusAction(){
         if(!empty($_POST['checkbox_team'])){
            $filteredinputs = array_filter(filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING));

            foreach($filteredinputs['checkbox_team'] as $key => $name){
                $teamBDD = new teamManager();
                $team = $teamBDD->getTeam(array('name'=>$name));
                
                if($team->getStatus()==1)
                    $team->setStatus(-1);
                else
                    $team->setStatus(1);

                $teamupdate = new teamManager();
                $teamupdate->changeStatusTeam($team);
            }    
            
        }

        // return false;

       header('Location: '.WEBPATH.'/admin');
    }

    public function updateUserStatusAction(){
        $args = array(
            'pseudo' => FILTER_SANITIZE_STRING,
            'status' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $userBDD = new userManager();
        $user = $userBDD->getUser(array('pseudo'=>$filteredinputs['pseudo']));

        $newuser = new user(array('status'=>$filteredinputs['status']));

        $userBDD->setUser($user, $newuser);
    }

    public function DeleteReportsAction(){
        $args = array(
            'id' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $reportsBDD = new signalmentsuserManager();
        $report = $reportsBDD->getReport($filteredinputs['id']);

        //$reportsBDD->delReport($report);
        $admin = new adminManager();
        var_dump($admin->getListReports());exit;        
    }
}