<?php
    
    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;


    class Teste extends Page {

        public function __construct() {

            try 
            {

                $config = parse_ini_file("Application/Config/loja.ini");

                extract($config);

                $conn = new PDO("$type:host=$host;dbname=$database", $user, $pass);

                $sql = "SELECT titulo, conteudo FROM cadastro_do_conteudo";

                $query = $conn->query($sql);
                $conteudos = $query->fetchAll(PDO::FETCH_OBJ);

                /*

                    print_r($conteudos);

                    echo '<br><br><br>'; 
                
                
                */

                
                

                $template = file_get_contents("Application/Templates/html/Home.html");


                if($conteudos) {

                    $contador = 1;

                    foreach($conteudos as $conteudo) {

                        
                        $artigo = "{$conteudo->titulo}: <br> {$conteudo->conteudo}";
                        $template = str_replace("{{content$contador}}", $artigo, $template);
                       

                        $contador = $contador + 1;

                    }

                    $contador = 1;

                }                               



                Transaction::close();

                echo $template;


            } catch (Exception $e) {

                print $e->getMessage();                

            }
           
        }


        


    }



?>