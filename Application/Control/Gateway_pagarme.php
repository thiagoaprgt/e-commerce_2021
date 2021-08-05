<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;     


    class Gateway_pagarme extends Page {

        private $endpoint = "https://api.pagar.me/1";
        private $array;

        public function __construct () {

            // O arquivo Pagarme.ini está no gitignore para não vazar a chave nos commit 
            
            $key = $this->api_Key();           
           

        }


        public function show() {

            parent::show();
            
            echo "<pre>";

            print_r($this->array);

            echo "</pre>";

        }


        public function api_Key() {
            $config = parse_ini_file("Application/Config/Pagarme.ini");

            $api_key = $config['api_key_pagarme'];

            return $api_key;
        }

        public function http_Post($post_data, $url) {
           
            // http_build_query gera a string de consulta (query) em formato URL

            $post_data = http_build_query($post_data);

            // informações http 
            
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );
            
            $context = stream_context_create($opts);      
            
            $result = file_get_contents($url, false, $context);        

        }


    }



?>