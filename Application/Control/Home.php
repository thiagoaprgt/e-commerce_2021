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


                /* ---------------------------------------------------------------------- */                


                // Criando uma paginação               
                
               
                    
                $criteria_pagination = new Criteria;

                $criteria_pagination->setProperty('order', 'data_do_cadastro desc'); 
                
                $repository_pagination = new Repository('Cadastro_do_conteudo');

                $count_titles = $repository_pagination->load($criteria_pagination);   

                $count_titles = count($count_titles);


                // limit é a quantidade de artigos que aparecem na páginas

                $limit = 1;

                $number_of_pages = $count_titles / $limit;

                
                // a função ceil() arredonda o resultado para o próximo inteiro acima.

                $number_of_pages = ceil($number_of_pages);

                
                $pages = array();

                $pagination = '';

                for ($i=0; $i < $number_of_pages ; $i++) { 


                    $pages[$i] = file_get_contents('Application/Templates/html/Pagination.html');
                    
                    $pages[$i] = str_replace('{{page_number}}', $i, $pages[$i]);

                    $pagination .= $pages[$i];

                    
                    
                }

                $home = file_get_contents("Application/Templates/html/Home.html");

                $home = str_replace('{{pagination}}', $pagination, $home);


                

                // Concluído com sucesso a criação da parte 1 da paginação termina aqui.


                /* ---------------------------------------------------------------------- */ 
               

                // Criando o conteúdo da tag section e parte 2 da paginação

                


                if ( isset($_GET['page_number']) && $_GET['page_number'] > 0 ) {

                    $pages_number = $limit * $_GET['page_number'];
                    
                }else {

                    $pages_number = 0;

                }


                $criteria = new Criteria;

                // desc = ordem descendente ou decrescente, asc = ordem ascendente ou crescente

                // offset faz começar a seleção apartir de uma informação
            
                $criteria->setProperty('order', 'data_do_cadastro desc');
                $criteria->setProperty('limit', $limit);
                $criteria->setProperty('offset', $pages_number);                
                

                $repository = new Repository('Cadastro_do_conteudo');
                $conteudos = $repository->load($criteria);                
                

                if(isset($conteudos)) {

                    foreach($conteudos as $conteudo) {
                        

                        $artigo = " {$conteudo->data_do_cadastro} <br> {$conteudo->titulo}: <br> {$conteudo->conteudo}";  

                        $template = file_get_contents('Application/Templates/html/Content.html');

                        $contents[] = str_replace("{{content}}", $artigo, $template); 
                        

                    }

                    $section = '';

                    foreach ($contents as $content) {
                        
                        $section .= $content;

                    }
                    

                    $this->template = str_replace('{{section}}', $section, $home);
                    

                }   
                

                // Concluído com sucesso a criação do conteúdo da tag section e paginação parte 2 

                /* ---------------------------------------------------------------------- */
                

                Transaction::close(); 


            } catch (Exception $e) {

                print $e->getMessage();

                Transaction::rollback();

            }
           
        }


        public function show() {

            parent::show();

            echo $this->template;

        }

        
        


    }



?>