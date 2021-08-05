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

            // Buscando uma página e enviando dados pelo método POST
           
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

            /*

            stream_context_create cria e retorna um fluxo de texto e aplica várias opções que podem ser usadas para fopen (), 
            file_get_contents () e outros procedimentos, como configurações de tempo limite, servidor proxy, método de solicitação, 
            informações de cabeçalho configuram um processo especial.

            É possível fazer o curl no php para simular os verbos HTTP como post

            */
            
            $context = stream_context_create($opts);      
            
            $result = file_get_contents($url, false, $context);        

        }


    }



?>