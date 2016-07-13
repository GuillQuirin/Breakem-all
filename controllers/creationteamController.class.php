<?php
class creationteamController extends template{
    public function creationteamAction(){

        //Initialisation de la vue
        $v = new view();
        $this->assignConnectedProperties($v);
        $v->assign("css", "creationteam");
        $v->assign("js", "creationteam");
        $v->assign("title", "creationteam");
        $v->assign("content", "Liste des teams");


        //Liste des teams
        $obj = new teamManager();
        $v->setView("creationteam");
    }



public function addTeamAction()
{

    if(isset($_SESSION['err_name'])){
        $v->assign("err_name","1");
        unset($_SESSION["err_name"]);
    }

    if(isset($_SESSION['err_desc'])){
        $v->assign("err_desc","1");
        unset($_SESSION["err_desc"]);
    }

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
        $uploaddir = '/web/img/upload/';
        $name = $_FILES['img']['name'];

        $uploadfile = getcwd().$uploaddir.$name;

        define('KB', 1024);
        define('MB', 1048576);
        define('GB', 1073741824);
        define('TB', 1099511627776);

        if ($_FILES['img']['size'] < 1 * MB) {
            if ($_FILES['img']['error'] == 0) {

                if (!move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile))
                    die("Erreur d'upload");
            }
        }
        $filteredinputs['img'] = $name;
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
