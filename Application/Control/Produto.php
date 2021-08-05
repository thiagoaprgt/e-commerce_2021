<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Produto extends Page {

        protected $template;

        public function __construct() {

            try{

                $this->template = file_get_contents("Application/Templates/html/Home.html");


                Transaction::open('loja');

                $criteria = new Criteria;
               

                $criteria->setProperty('order', 'id');

                $repository = new Repository('Lista_dos_produtos');

                $produtos = $repository->load($criteria);                              

                
                $list = "";                
                $template_list_li = file_get_contents("Application/Templates/html/Lista_dos_produtos/Lista_dos_produtos_li.html");

                $template_list = "";

                foreach($produtos as $produto) {
                                        
                    $list = "Descrição: \t $produto->descricao<br>";
                    $list .= "Estoque: \t $produto->estoque<br>";                    
                    $list .= "Preço: \t $produto->preco_venda<br>";
                    $list .= "Código de barras: \t $produto->codigo_de_barras<br>";
                    
                    
                    $list = str_replace("{{produtos}}", $list, $template_list_li);
                    $list = str_replace("{id_produto}", $produto->id, $list);

                    $template_list .= $list;
                    
                }

                

                $template_list_ul = file_get_contents("Application/Templates/html/Lista_dos_produtos/Lista_dos_produtos_ul.html");

                $template_list_ul = str_replace("{{produtos}}", $template_list, $template_list_ul);

                $this->template = str_replace("{{section}}", $template_list_ul, $this->template);                


                Transaction::close();
                
                
            }catch(Exception $e) {

                print $e->getMessage();

                Transaction::rollback();

            }

        }


        public function show() {

            parent::show();  
            
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";

            echo $this->template;

        }

    }



?>