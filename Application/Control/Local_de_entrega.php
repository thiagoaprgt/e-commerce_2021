<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;    
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;
    use Thiago_AP\Pagination\Pagination;
    

    class Local_de_entrega extends Page {

        private $template;
        private $local_de_entrega;

        public function __construct() {

            if(empty($_SESSION) ) {

                header("Location:index.php?class=Login");

            }

            try {

                Transaction::open('loja');

                $home = file_get_contents("Application/Templates/html/Home.html");

                $this->template = file_get_contents("Application/Templates/html/Checkout_da_compra/Form_local_de_entrega.html");
    
                $criteria = new Criteria;
                $criteria->add('id', '=' , $_SESSION['id']);
    
                $repository = new Repository('Tabela_local_de_entrega');            
                
                $objects = !empty($repository->load($criteria)) ? $repository->load($criteria) : null;
    
    
                $form_local_de_entrega_cadastrados = file_get_contents("Application/Templates/html/Checkout_da_compra/Locais_de_entrega_cadastrados.html");
    
                $local_de_entrega_cadastrados = "";
                
    
                if(isset($objects)) {
    
                    foreach($objects as $obj) {   
                        
                        $replace = "";
                        $replace = str_replace("{country}", $obj->country, $form_local_de_entrega_cadastrados);
                        $replace = str_replace("{street}", $obj->street, $replace);
                        $replace = str_replace("{street_number}", $obj->street_number, $replace);
                        $replace = str_replace("{state}", $obj->state, $replace);
                        $replace = str_replace("{city}", $obj->city, $replace);
                        $replace = str_replace("{neighborhood}", $obj->neighborhood, $replace);
                        $replace = str_replace("{zipcode}", $obj->zipcode, $replace);                        
                        $replace = str_replace("{id_local_de_entrega}", $obj->id, $replace);
        
                        $local_de_entrega_cadastrados .= $replace;  
        
                    }
    
                    $this->template = str_replace("{locais_de_entrega_cadastrados}", $local_de_entrega_cadastrados, $this->template);
    
                }else {
    
                    $this->template = str_replace("{locais_de_entrega_cadastrados}", "", $this->template);
    
                }
    
    
                $this->template = str_replace("{{section}}", $this->template, $home);


                Transaction::close();

            }catch(Exception $e) {

                print $e->getMessage();

                Transaction::rollback();

            }
                   
            
        }

        public function show() {

            parent::show();             

            echo $this->template;

        }


        
        
        


    }



?>