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

    $template = file_get_contents("Application/Templates/html/Home.html");




    if(isset($_GET['class'])) {

        $class = $_GET['class'];

    }else {

        $class = 'Home';
        
    }    


    if(class_exists($class)) {
            
        try{

            $pagina = new $class; // instancia a classe

            ob_start(); // inicia o controle de output

            $pagina->show(); // exibe a página

            $content = ob_get_contents(); // lê conteúdo gerado

            ob_end_clean(); // finaliza o controle de output

        }catch(Exception $e) {

            $content = $e->getMessage() . '<br>' . $e->getTraceAsString();

        }

    }


    echo $content;


   


    



    

    


?>