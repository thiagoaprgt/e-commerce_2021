<?php
    
    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Home extends Page {

        public function __construct() {

            $template;

            try 
            {

                Transaction::open('loja');


                $criteria = new Criteria;
                $criteria->setProperty('order', 'id');

                $repository = new Repository('Cadastro_do_conteudo');
                $conteudos = $repository->load($criteria);

                $this->template = file_get_contents("Application/Templates/html/Home.html");


                if($conteudos) {

                    $contador = 1;

                    foreach($conteudos as $conteudo) {


                        $artigo = "{$conteudo->titulo}: <br> {$conteudo->conteudo}";
                        $this->template = str_replace("{{content$contador}}", $artigo, $this->template);  
                        
                        

                        $contador = $contador + 1;
                    }

                    $contador = 1;

                }                               



                Transaction::close();

                
                


            } catch (Exception $e) {

                print $e->getMessage();

                Transaction::rollback();

            }
           
        }


        public function show() {

            echo $this->template;

        }
        


    }



?>