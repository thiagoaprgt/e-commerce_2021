<?php  

    use Thiago_AP\Control\Page;
    use Thiago_AP\Http_request\Http_request;
    use Thiago_AP\Database\Transaction;    
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;



    class Gateway_pagarme extends Page {

        private $endpoint;                  
        private $data;

        private $credit_card_id;



           
        

        public function __construct () {

            // O arquivo Pagarme.ini está no gitignore para não vazar a chave nos commit 

            $this->endpoint = "https://api.pagar.me/1";  

            
            $this->type_of_payment = isset($_SESSION['type_of_payment']) ? $_SESSION['type_of_payment'] : 'boleto';

            $key = $this->api_Key();


            $this->data['api_key'] = $key;

            $this->data['payment_method'] = $_POST['payment_method'];

            $this->credit_card_Data();             
            
            $this->data['customer'] = $this->set_Customer();
            $this->data['billing'] = $this->set_Billing();
            $this->data['shipping'] = $this->set_Shipping();
            $this->data['items'] = $this->set_Items();
            

        }


        public function show() { 
            
            parent::show(); 
            
            echo "<pre>";
            print_r($this->data);
            echo "</pre>";
            

        }


        private function api_Key() {

            $config = parse_ini_file("Application/Config/Pagarme.ini");

            $api_key = $config['api_key_pagarme'];

            return $api_key;
        }
        
        
        public function set_Customer() {           
            
            
            return $this->customer = isset($_SESSION['customer']) ? $_SESSION['customer'] : null;

        }


        public function set_Billing() {

            $this->data['billing']['name'] = isset($_POST['card_holder_name']) ? $_POST['card_holder_name'] : null;

            $this->data['billing']['address'] = isset($_SESSION['address']) ? $_SESSION['address'] : "";

            return  $this->data['billing'];           
            
        }

        public function set_Shipping() {

            $this->data['shipping']['name'] = isset($_POST['card_holder_name']) ? $_POST['card_holder_name'] : null;
            $this->data['shipping']['fee'] = 3000;
            $this->data['shipping']['delivery_date'] = isset($_POST['delivery_date']) ? $_POST[''] : null;
            $this->data['shipping']['expedited'] = isset($_POST['expedited']) ? $_POST[''] : null;

            $this->data['shipping']['address'] = isset($_SESSION['address']) ? $_SESSION['address'] : null;

            return $this->data['shipping'];

        }

        public function set_Items() {

            return $this->items = isset($_SESSION['items']) ? $_SESSION['items'] : "";

        }    
        
        
        public function credit_card_Data() {

            if($this->data['payment_method'] == 'credit_card') {

                
                $url = "https://api.pagar.me/1/cards";

                $key = $this->api_Key();
                
                
                $array['api_key'] = $key;
                $array['holder_name'] = isset($_POST['card_holder_name']) ? $_POST['card_holder_name'] : null;
                $array['number'] = isset($_POST['card_number']) ? $_POST['card_number'] : null;
                $array['expiration_date'] = isset($_POST['card_expiration_date']) ? $_POST['card_expiration_date'] : null;
                $array['cvv'] = isset($_POST['card_cvv']) ? $_POST['card_cvv'] : null;
                
                

                $http = new Http_request;   
                
                $credit_card = $http->http_post_Request($url, $array);
                $credit_card = json_decode($credit_card);

                $this->data['amount'] = isset($_SESSION['amount']) ? $_SESSION['amount'] : null;
                $this->data['card_id'] = $credit_card->id;

                
            }

        }

       
        

        

        public function send_checkout_credit_Card() {

            $url = "https://api.pagar.me/1/transactions";

            $array = $this->data;

            $request = new Http_request;

            $request->http_post_Request($url, $array); 

            header("location:index.php?authentication=" . $_SESSION['authentication'] . "&class=Carrinho_de_compra&method=remover_todos_os_Produtos");

        }


    }



?>