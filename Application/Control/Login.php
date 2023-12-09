<?php

    use Thiago_AP\Control\Page;

    class Login extends Page {

        private $template;

        public function __construct() {            

            
            $this->template = file_get_contents("Application/Templates/html/Home.html");
            
            $template = file_get_contents("Application/Templates/html/Login.html");

            $this->template = str_replace("{{section}}", $template, $this->template);

            // parent::show é a função da classe Page 
            
        }
        

        public function show() {

            parent::show();             
            echo $this->template;

        }


        public function unregistered_User() {

            echo "<br> Senha ou Login está errado <br>";

        }

    }


?>