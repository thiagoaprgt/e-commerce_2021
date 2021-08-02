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

            session_start();

            $pagina = new $class; // instancia a classe

            ob_start(); // inicia o controle de output

            

            if(isset($_GET['authentication'])) {
                

                $authentication = new Thiago_AP\Authentication\Authentication;
                $authentication->login_Authentication();                

                
                $pagina->show(); // exibe a página                
                
                $content = ob_get_contents(); // lê conteúdo gerado
                

                $validation = $_SESSION['authentication'];

                $content = str_replace("{authentication}", "authentication=" . $validation, $content);

                $content = str_replace("class=Login", "class=Logout", $content);
                $content = str_replace("{entrar}", "Logout", $content );

                $content = str_replace("{{pagination}}", "", $content );
                $content = str_replace("{{pagination}}", "", $content );

                $content = str_replace("{Cadastre-se}", "Carrinho de compra", $content );
                $content = str_replace("class=Cadastrar_se", "class=Carrinho_de_compra", $content );

                
                

            }else {

                
                $pagina->show(); // exibe a página

                

                $content = ob_get_contents(); // lê conteúdo gerado

                $content = str_replace("{authentication}", "", $content);
                $content = str_replace("{entrar}", "Login", $content);
                $content = str_replace("{{pagination}}", "", $content);
                $content = str_replace("{Cadastre-se}", "Cadastre-se", $content);
                $content = str_replace("id_produto={id_produto}", "", $content);
                
            }


            // finaliza o controle de output    

            ob_end_clean();
                        

        }catch(Exception $e) {

            $content = $e->getMessage() . '<br>' . $e->getTraceAsString();            

        }

    }


    echo $content;


   


    



    

    


?>