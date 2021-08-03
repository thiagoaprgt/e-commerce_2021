<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;    
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;
    use Thiago_AP\Pagination\Pagination;


    class Checkout extends Page {

        private $template;
        private $local_de_entrega;

        public function __construct() {

            if(empty($_SESSION)) {

                header("Location:index.php?class=Login");

            }

            $home = file_get_contents("Application/Templates/html/Home.html");

            $this->template = file_get_contents("Application/Templates/html/Checkout_da_compra/Checkout_da_compra.html");

            $this->template = str_replace("{{section}}", $this->template, $home);

        }

        public function show() {

            parent::show();            

            echo $this->template;

        }


        public function local_de_Entrega() {

        }


        public function send_pagarme_Checkout() {            

        }

    }



?>