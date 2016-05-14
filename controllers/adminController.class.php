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

            $listeplatforms = $admin->getListPlatform();
            
            $listesignalement = $admin->getListReports();
           
            $listeteam = $admin->getListTeam();

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
        $pm = new adminManager();
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

    public function updateTeamStatusAction(){
        var_dump($_POST);
                    var_dump($_POST['checkbox_team']);

         if(!empty($_POST['checkbox_team'])){
        //     // $filteredinputs = filter_input(INPUT_POST,'checkbox_team',FILTER_SANITIZE_STRING);
        //     $args = array(
        //                 'checkbox_team' => FILTER_SANITIZE_STRING
        //                 );
            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $_POST['checkbox_team']));
            var_dump($filteredinputs);
            return false;

            foreach($filteredinputs as $key => $id){
                // $id = substr($fullid,-1);
                $teamBDD = new teamManager();
                $team = $teamBDD->getTeam(array('id'=>$id));
                
                if($team->getStatus()==1)
                    $team->setStatus(-1);
                else
                    $team->setStatus(1);

                $adm = new adminManager();
                $adm->changeStatusTeam($team);
            }    
            
        }

        // return false;

       header('Location: '.WEBPATH.'/admin');
    }
}