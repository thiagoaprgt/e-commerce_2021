<?php

    
    //use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction; 
    use Thiago_AP\Database\Record;   
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Cadastro_de_novos_clientes extends Record {

        private $activeRecord;

        
        public function __construct() {           
            

            try {

                Transaction::open('loja');  
                
                
                
                $this->activeRecord = new Cadastro_do_cliente;

                $this->activeRecord->fromArray($_POST);

                $this->activeRecord->store();               


                             
                Transaction::close();


            }catch(Exception $e) {
    
                print $e->getMessage();
    
                Transaction::rollback();
    
            }
            

        }

        public function show() {

            header("Location:index.php"); 

        }



    }





?>