<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Contato extends Page {

        protected $template;

        public function __construct() {

            $home = file_get_contents('Application/Templates/html/Home.html');

            $this->template = file_get_contents("Application/Templates/html/Contato.html");

            $this->template = str_replace("{{section}}", $this->template, $home);

        }

        
        public function show() {

            parent::show();

            echo $this->template;
        }

    }



?>