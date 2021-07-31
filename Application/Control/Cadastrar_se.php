<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Cadastrar_se extends Page {

        protected $template;

        public function __construct() {

            $this->template =  file_get_contents("Application/Templates/html/Cadastre-se.html");

            $form = file_get_contents("Application/Templates/html/Cadastre-se.html");

            $this->template = str_replace("{{section}}", $form, $this->template);

        }
        

        public function show() {

            parent::show();

            echo $this->template;

        }       

    }


?>