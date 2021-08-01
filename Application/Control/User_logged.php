<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;
    use Thiago_AP\Authentication\Authentication;
    

    class User_logged extends Page {

        private $template;
        protected $authentication;

        public function __construct() {

            if( isset($_POST['email']) && isset($_POST['password']) ) {

                Transaction::open('Loja');

                $email = $_POST['email'];
                $password = $_POST['password'];

                $repository = new Repository("Cadastro_do_cliente");

                $criteria = new Criteria();

                $criteria->add('email', '=', $email);
                $criteria->add('senha', '=', $password);

                $user_dataset = $repository->load($criteria);


                /* ----------------------------------------------- */
                // teste               


                
                /*

                echo "<pre>";


                print_r($user_dataset);
                
                $data = $user_dataset[0];

                echo "O cliente $data->nome foi logado com sucesso !!! <hr>";

                echo "</pre>";

                */
                

                //fim do teste

                /* ---------------------------------------------------- */


                if(empty($user_dataset)) {

                    header("Location:index.php?class=Login&method=unregistered_User");

                }


                $object = $user_dataset[0];

                echo "O cliente $object->nome foi logado com sucesso !!! <hr>";
                

                session_start();

                $_SESSION['id'] = $object->id;
                $_SESSION['nome'] = $object->nome;                           
                $_SESSION['cidade'] = $object->cidade;
                $_SESSION['estado'] = $object->estado;
                $_SESSION['bairro'] = $object->bairro;
                $_SESSION['rua'] = $object->rua;
                $_SESSION['numero'] = $object->numero;
                $_SESSION['complemento'] = $object->complemento;

                echo "<pre>";

                print_r($_SESSION);

                echo "</pre>";

                $authentication = new Authentication();
                $authentication->set_Authentication($object->email);

                $auth = $authentication->get_Authentication();                  

                

                
                echo "<pre>";

                print_r($authentication);

                echo "<br>";
                
                print_r($_SESSION);

                echo "<br>";

                echo $auth;

                

                echo "</pre>";
            
                
                
                Transaction::close(); 

                 
                

                header("Location:index.php?class=Home&authentication=$auth");


            }else {

                header("Location:index.php?class=Login");
            }

        }

        

        

    }




?>