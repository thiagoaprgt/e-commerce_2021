<?php

    
    // Library loader

    require_once 'Library/Thiago_AP/Core/ClassLoader.php';

    // al é uma abreviação para auto load

    $al = new Thiago_AP\Core\ClassLoader;
    $al->addNamespace('Thiago_AP', 'Library\Thiago_AP');
    $al->register();

    // Application loader

    require_once 'Library/Thiago_AP/Core/ApplicationLoader.php';
    $al = new Thiago_AP\Core\ApplicationLoader;
    $al->addDirectory('Application/Control');
    $al->addDirectory('Application/Model');    
    $al->register();
    

    // Vendor    

    $loader = require_once 'vendor/autoload.php';
    $loader->register();

    

    if(isset($_GET['class'])) {

        $class = $_GET['class'];

    }else {

        $class = 'Home';
        
    }    


    if(class_exists($class)) {
            
        try{

            $pagina = new $class; // instancia a classe

            ob_start(); // inicia o controle de output

            session_start();

            if(isset($_GET['authentication'])) {


                 
                
                
            
                print_r($_SESSION);
                
                echo "<hr><br>";

                $current_time = time();
                echo "tempo atual : $current_time";

                

                $authentication = new Thiago_AP\Authentication\Authentication;
                $authentication->login_Authentication();

                
                $pagina->show(); // exibe a página                
                
                $content = ob_get_contents(); // lê conteúdo gerado

                

                

                $validation = $_SESSION['authentication'];

                $content = str_replace("{authentication}", "authentication=" . $validation, $content);
                $content = str_replace("class=Login", "class=Logout", $content);
                $content = str_replace("{entrar}", "Logout", $content );

                
                

            }else {

                $pagina->show(); // exibe a página

                

                $content = ob_get_contents(); // lê conteúdo gerado

                $content = str_replace("{authentication}", "", $content);
                $content = str_replace("{entrar}", "Login", $content);

                             

                
                
            }


                       

            ob_end_clean();
            
            // finaliza o controle de output

        }catch(Exception $e) {

            $content = $e->getMessage() . '<br>' . $e->getTraceAsString();

            //$content = str_replace("{authentication}", "", $content);

        }

    }


    echo $content;


   


    



    

    


?>