<?php


    namespace Thiago_AP\Pagination;

    use Thiago_AP\Database\Transaction;
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Pagination {

        private $template;
        private $limit;
        private $offset;
        

        public function __construct( string $base_template, string $table_class_name, string $table_name, $ordination = 'asc', $limit = 1) {

            // Criando uma paginação               
                
            /*
            $operator_sql pode ser order, limit e offset 
            $table_class_name são as classes que estão na pasta Application/Model            
            
            */

            try {

                
                Transaction::open('loja');
                

                $table_name = $table_name . " " . $ordination;
                        
                $criteria_pagination = new Criteria;

                $criteria_pagination->setProperty( 'order', $table_name); 
                
                $repository_pagination = new Repository($table_class_name);

                $count_titles = $repository_pagination->load($criteria_pagination);   

                $count_titles = count($count_titles);


                // limit é a quantidade de artigos que aparecem nas páginas

                $this->limit = $limit;
                
                if($limit > 0 || $limit != null) {

                    $number_of_pages = $count_titles / $limit;

                }else {

                    $number_of_pages = 1;

                }

                
                // a função ceil() arredonda o resultado para o próximo inteiro acima.

                $number_of_pages = ceil($number_of_pages);

                
                $pages = array();

                $pagination = '';

                for ($i=0; $i < $number_of_pages ; $i++) { 


                    $pages[$i] = file_get_contents('Application/Templates/html/Pagination/Pagination.html');
                    
                    $pages[$i] = str_replace('{{page_number}}', $i, $pages[$i]);

                    $pagination .= $pages[$i];

                    
                    
                }


                $pagination_navbar =  file_get_contents("Application/Templates/html/Pagination/Pagination_navbar.html");

                $pagination_navbar = str_replace('{{pagination}}', $pagination, $pagination_navbar);



                $home = file_get_contents($base_template);

                $home = str_replace('{{pagination}}', $pagination_navbar, $home);


                $this->template = $home;  

                                
                
                /* --------------------------------------------------------------------- */


                 // Criando o conteúdo da tag section e parte 2 da paginação

                


                if (isset($_GET['page_number']) && $_GET['page_number'] > 0 ) {

                    $this->offset = $limit * $_GET['page_number'];
                    
                }else {

                    $this->offset = 0;

                }

                
                Transaction::close();                

               
                

                // Concluído com sucesso a criação da parte 2 
                                


            }catch(Exception $e) {

                print $e->getMessage();

                Transaction::rollback();


            }

                

                

        }


        public function get_Pagination() {

            $pagination = array();

            $pagination['pagination_template'] = $this->template;
            $pagination['limit'] = $this->limit;
            $pagination['offset'] = $this->offset;

 
            return $pagination;

        }


    }




?>