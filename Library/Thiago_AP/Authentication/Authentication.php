<?php

    namespace Thiago_AP\Authentication;

    class Authentication {

        protected $log_in_time; 
        protected $expiration_time;
        protected $authentication;        
                
        
        public function __construct() {

            /*
            
                A função time() retorna a hora atual medida em segundos desde a época do Unix (1 de janeiro de 1970 00:00:00 GMT).

            */

            $this->log_in_time = time(); 
            $this->expiration_time = $this->log_in_time + 1800;

        }


        public function verify_expiration(){
            
            $current_time = time();

            if($current_time >= $_SESSION['expiration_time']) {

                session_unset();
                session_destroy();
                
                header("Location:index.php?class=Login");
                
               

            }

        }


        public function set_Authentication($name) {

            // a função rand gera um número aletório no intervalo entre dois valores;

            $authentication_number = rand(100000,999999999);

            $authentication = $name.$authentication_number;

            $this->authentication = md5($name . $authentication_number);

            if(isset($_SESSION)){

                

                $_SESSION['authentication'] = $this->authentication;
                $_SESSION['expiration_time'] = $this->expiration_time;

               

            }else {

                session_start();

                $_SESSION['authentication'] = $this->authentication;
                $_SESSION['expiration_time'] = $this->expiration_time;

                session_destroy();

            }

            

           
            

        }


        public function login_Authentication() {

            

            if(isset($_GET['authentication'])) {

                

                if($_GET['authentication'] == $_SESSION['authentication']) {

                    
                    $this->verify_expiration();

                }else {

                                       
                    session_destroy();

                    header("Location:index.php?class=Login");

                }

                
                

            }
            

        }


        public function get_Authentication() {

            
            return $this->authentication;
                        

        }

        


    }




?>