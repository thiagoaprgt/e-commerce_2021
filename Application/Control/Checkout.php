<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;    
    use Thiago_AP\Database\Criteria;  
    use Thiago_AP\Database\Repository;
    use Thiago_AP\Database\Record;


    class Checkout extends Page {

        private $template;
        private $local_de_entrega;
        private $payment_method;

        public function __construct() {            

            $home = file_get_contents("Application/Templates/html/Home.html");

            $this->template = file_get_contents("Application/Templates/html/Checkout_da_compra/Checkout_da_compra.html");

            $this->template = str_replace("{{section}}", $this->template, $home);

        }

        public function show() {

            parent::show();  
            
            $this->get_local_de_Entrega();

            $this->payment_method(); 

            

            echo $this->template;

        }


        public function local_de_Entrega() {            

            $_SESSION['address'] = $_POST;

            try{

                Transaction::open('loja');     

                $local_de_entrega = new Tabela_local_de_entrega;

                $array['id_cliente'] = $_SESSION['id'];
               
                foreach($_POST as $key => $value) {
                    $array["{$key}"] = $value;
                }

                $local_de_entrega->fromArray($array);

                $local_de_entrega->store();
                               

                Transaction::close();

            }catch(Exception $e) {

                print $e->getMessage();
                Transaction::rollback();
            }

            
            
        }


        public function get_local_de_Entrega() {

            if(empty($_SESSION['address'])) {

                $template = file_get_contents("Application/Templates/html/Checkout_da_compra/Local_de_entrega.html");

                $local_de_entrega = str_replace("{{local_de_entrega}}", "Local da entrega não informado.", $template);

                $this->template = str_replace("{{local_de_entrega}}", $local_de_entrega, $this->template);

                $this->template = str_replace("{{payment_method}}", "", $this->template);


                $this->payment_method = false;

            }else{               

                $template = file_get_contents("Application/Templates/html/Checkout_da_compra/Local_de_entrega.html");

                $local_de_entrega = "";

                foreach($_SESSION['address'] as $key => $value) {                    

                    $local_de_entrega .= str_replace("{{local_de_entrega}}", $key . ": " . $value, $template);      

                }

                $this->template = str_replace("{{local_de_entrega}}", $local_de_entrega, $this->template);

                $this->payment_method = true;

            }
            

        }


        public function payment_method() {

            if($this->payment_method == false) {
                header("Location:index.php?authentication=" . $_SESSION['authentication'] . "&class=Local_de_entrega");
            }

            $form =  file_get_contents("Application/Templates/html/Checkout_da_compra/Form_payment_method.html");
            
            $this->template = str_replace("{{payment_method}}", $form, $this->template);

            $amount = $_SESSION['amount'] /100;

            $amount = number_format($amount, 2, ',', '');         

            $this->template = str_replace("{amount}", "R$ " . $amount, $this->template);

        }

        

    }



?>