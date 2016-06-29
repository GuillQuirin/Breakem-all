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

    $args = array(
        'id' => FILTER_VALIDATE_INT,
        'name' => FILTER_SANITIZE_STRING,
        'description' => FILTER_SANITIZE_STRING,
        'img' => FILTER_SANITIZE_STRING,
        'slogan' => FILTER_SANITIZE_STRING

    );

    $filteredinputs = filter_input_array(INPUT_POST, $args);

    if (isset($_FILES['img'])) {

        $uploaddir = '/web/img/upload/';
        $name = $_FILES['img']['name'];

        $uploadfile = getcwd().$uploaddir.$name;
//var_dump($uploadfile);

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

    $teamBDD = new teamManager();
    $teamBDD->mirrorObject = new team($filteredinputs);
    $teamBDD->create();
    $idteam = new userManager();
    $t = $idteam->SearchIdTeam($filteredinputs['name']);
  
    $idteam->setNewTeamId( $this->connectedUser->getId(), $t[0]["id"] );


   header('Location: '.WEBPATH.'/detailteam?name='.$filteredinputs['name']);

}


}
