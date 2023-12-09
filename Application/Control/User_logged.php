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


                if(empty($user_dataset)) {

                    Transaction::close(); 

                    header("Location:index.php?class=Login&method=unregistered_User");

                }else {


                    $object = $user_dataset[0];

                    
                    $_SESSION['id'] = $object->id;

                    // customer será usado na API do gateway de pagamento da empresa PAGARME

                    $telefone = '+55' . $object->ddd_telefone . $object->telefone;
                    
                    // coverte o valor para string

                    $telefone = strval($telefone);

                    $_SESSION['customer'] = [
                        
                        'external_id' => $object->id,
                        'name' => $object->nome,
                        'type' => 'individual',
                        'country' => 'br',

                        'documents' => [

                            [
                                'type' => 'cpf',
                                'number' => $object->cpf
                            ]

                        ],

                        'phone_numbers' => [$telefone],
                        'email' => $object->email
                    ];                   
                    

                    $authentication = new Authentication();
                    $authentication->set_Authentication($object->email);
                    $auth = $authentication->get_Authentication();
                    
                    Transaction::close(); 

                    header("Location: index.php?class=Home&authentication=$auth");

                }

            }else {

                header("Location:index.php?class=Login");
            }

        }

        

        

    }




?>