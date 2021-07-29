<?php
    
    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;    
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;
    use Thiago_AP\Pagination\Pagination;
    
    


    class Home extends Page {

        protected $template;

        public function __construct() {           

            try 
            {
               
                // Criando uma paginação 

                $base_template = "Application/Templates/html/Home.html";                
                $table_class_name = 'Cadastro_do_conteudo';
                $table_name = 'data_do_cadastro';
                $ordination = 'desc'; 
                $limit = 1;                
               
                $pagination = new Pagination($base_template, $table_class_name, $table_name, $ordination, $limit);  

                // extract transforma cada elemento do vetor em variáveis isoladas onde o nome da variável é nome da chave
                
                extract( $pagination->get_Pagination() ); 
                
                // variáveis extraídas: $pagination_template, $limit, $offset
                

                // Concluído com sucesso a criação da paginação.

                /* ---------------------------------------------------------------------- */ 

                

                Transaction::open('loja');                

                $criteria = new Criteria;

                // desc = ordem descendente ou decrescente, asc = ordem ascendente ou crescente

                // offset faz começar a seleção apartir de uma informação
            
                $criteria->setProperty('order', 'data_do_cadastro desc');
                $criteria->setProperty('limit', $limit);
                $criteria->setProperty('offset', $offset);                
                

                $repository = new Repository('Cadastro_do_conteudo');
                $conteudos = $repository->load($criteria);                
                

                if(isset($conteudos)) {

                    foreach($conteudos as $conteudo) {
                        

                        $artigo = " {$conteudo->data_do_cadastro} <br> {$conteudo->titulo}: <br> {$conteudo->conteudo}";  

                        $content_template = file_get_contents('Application/Templates/html/Content.html');

                        $contents[] = str_replace("{{content}}", $artigo, $content_template); 
                        

                    }

                    $section = '';

                    foreach ($contents as $content) {
                        
                        $section .= $content;

                    }
                    

                    $this->template = str_replace('{{section}}', $section, $pagination_template);
                    

                } 
                

                // Concluído com sucesso a criação do conteúdo da tag section
                

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