<?php

    use Thiago_AP\Control\Page;

    class Login extends Page {

        private $template;

        public function __construct() {

            

            $this->template = file_get_contents("Application/Templates/html/Login.html");

            // parent::show é a função da classe Page 

            parent::show(); 


        }
        

        public function show() {

            

            echo $this->template;

        }


        public function unregistered_User() {

            echo "<br> Senha ou Login estão errado <br>";

        }

    }


?>