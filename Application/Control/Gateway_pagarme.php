<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Http_request\Http_request;
       


    class Gateway_pagarme extends Page {

        private $endpoint;    
        private $request;        
        private $data;

        private $customer;
        private $billing;
        private $shipping;
        private $items;
        private $type_of_payment;
        private $credit_card;

        public function __construct () {

            // O arquivo Pagarme.ini está no gitignore para não vazar a chave nos commit 

            $this->endpoint = "https://api.pagar.me/1";

            $this->request = new Http_request;
            
            $this->type_of_payment = isset($_SESSION['type_of_payment']) ? $_SESSION['type_of_payment'] : 'boleto';

            $key = $this->api_Key();


            $this->data[] = $key;

            
            if($this->type_of_payment == 'credit_card') {

                $this->data[] = $this->credit_card_Payment();

            }


            $this->data[] = set_Customer();
            $this->data[] = set_Billing();
            $this->data[] = set_Shipping();
            $this->data[] = set_Items();                       

        }


        public function show() {

            parent::show();
            
            echo "<pre>";

            print_r($this->array);

            echo "</pre>";

        }


        private function api_Key() {

            $config = parse_ini_file("Application/Config/Pagarme.ini");

            $api_key = $config['api_key_pagarme'];

            return $api_key;
        }
        
        
        public function set_Customer() {
           
            $this->customer = isset($_SESSION['customer']) ? $_SESSION['customer'] : "";

        }


        public function set_Billing() {

            $this->billing = isset($_SESSION['billing']) ? $_SESSION['billing'] : "";
            
        }

        public function set_Shipping() {

            $this->shipping = isset($_SESSION['shipping']) ? $_SESSION['shipping'] : "";

        }

        public function set_Items() {

            $this->items = isset($_SESSION['items']) ? $_SESSION['items'] : "";

        }     
        
        
        public function credit_card_Payment() {

            $this->credit_card['amount'] = isset($_SESSION['amount']) ? $_SESSION['amount'] : "";
            $this->credit_card['card_number'] = isset($_SESSION['card_number']) ? $_SESSION['card_number'] : "";
            $this->credit_card['card_cvv'] = isset($_SESSION['card_cvv']) ? $_SESSION['card_cvv'] : "";
            $this->credit_card['card_expiration_date'] = isset($_SESSION['card_expiration_date']) ? $_SESSION['card_expiration_date'] : "";
            $this->credit_card['card_holder_name'] = isset($_SESSION['card_holder_name']) ? $_SESSION['card_holder_name'] : "";

        }


    }



?>