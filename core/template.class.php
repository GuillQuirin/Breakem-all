<?php
class template{
        public function connexionAction(){
                $requiredPosts = array(
                    'email'   => FILTER_VALIDATE_EMAIL,
                    'password'   => FILTER_SANITIZE_STRING
                );
                $filteredinputs = filter_input_array(INPUT_POST, $requiredPosts);
                // Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
                $finalArr = [];
                foreach ($requiredPosts as $key => $value) {
                        if(!isset($filteredinputs[$key]))
                                die("Erreur: ".$key);
                        $finalArr[$key] = escapeshellcmd(trim($filteredinputs[$key]));
                }

                $user = new user($finalArr);
                $userManager = new userManager();
                $userDB = $userManager->tryConnect($user->getEmail());
                if($userDB === FALSE){
                        unset($userManager, $userDB);
                        die("Email inconnu !");
                }
                // var_dump($userDB);

                if(password_verify($user->getPassword(), $userDB->getPassword())){
                    //var_dump($user);
                    //var_dump("Password et email valides !");
                    foreach ($userDB as $key => $value) {
                        $method = 'get'.ucfirst($value);
                        if (method_exists($userDB, $method))
                            $_SESSION['connected'][$key] = $userDB->$method();                            
                    }
                    var_dump($_SESSION);
                }
                else{
                        unset($userManager, $userDB);
                        die("Password fail !");
                }
        }

        public function deconnexionAction(){
            if(isset($_SESSION['id'])){
                
                $userBDD = new userManager();

                $args = array(
                    'pseudo' => FILTER_SANITIZE_STRING
                );
                $filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

                $user = $userBDD->getUser($filteredinputs);
                
                $user->setOnline(0);
                $user->setLastTime(time());

                session_destroy($_SESSION);
                
                $v = new View();
                 $v->assign("css", "index");
                 $v->assign("js", "index");
                 $v->assign("title", "Index");
                 $v->assign("content", "Bienvenue sur Breakem-all !");
                 $v->assign("login", FALSE);

                $v->setView("index");
            }
        }
}
