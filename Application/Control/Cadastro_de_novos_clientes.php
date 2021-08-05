<?php    
    
    use Thiago_AP\Database\Transaction; 
    use Thiago_AP\Database\Record;   
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Cadastro_de_novos_clientes extends Record {

        private $activeRecord;
        private $registered = false;
        

        
        public function __construct() {           
            

            try {

                Transaction::open('loja');

                $criteria = new Criteria();
                $criteria->add('email', '=', $_POST['email']);
                
                $repository = new Repository("Cadastro_do_cliente");
                $db = $repository->load($criteria);              
               

                if($_POST['email'] == $db[0]->email) {

                    $this->registered = false;

                    throw new Exception("Já existe um cliente com o email " . $_POST['email'] . " cadastrado.");

                }else {

                    $this->registered = true;

                }
                                
                
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

            if($this->registered == true) {

                header("Location:index.php");

            }

        }



    }





?>