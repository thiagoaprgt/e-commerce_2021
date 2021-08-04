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
            
            $this->get_local_de_Entrega();

            echo $this->template;

        }


        public function local_de_Entrega() {            

            $_SESSION['address'] = $_POST;

            
        }


        public function get_local_de_Entrega() {


            if(empty($_SESSION['address'])) {

                $template = file_get_contents("Application/Templates/html/Checkout_da_compra/Local_de_entrega.html");

                $local_de_entrega = str_replace("{{local_de_entrega}}", "Local da entrega não informado.", $template);

                $this->template = str_replace("{{local_de_entrega}}", $local_de_entrega, $this->template);

            }else{               

                $template = file_get_contents("Application/Templates/html/Checkout_da_compra/Local_de_entrega.html");

                $local_de_entrega = "";

                foreach($_SESSION['address'] as $key => $value) {

                    

                    $local_de_entrega .= str_replace("{{local_de_entrega}}", $key . ": " . $value, $template);                    
                }

                $this->template = str_replace("{{local_de_entrega}}", $local_de_entrega, $this->template);

            }

            

            
            

           
            

        }


        public function send_pagarme_Checkout() {            

        }

    }



?>