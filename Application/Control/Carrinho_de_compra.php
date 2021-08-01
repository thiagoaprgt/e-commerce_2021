<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;    
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Carrinho_de_compra extends Page {

        private $template;

        
        public function __construct() {

            try{

                Transaction::open("loja");

                // a sessão é iniciada no index.php
                // a sessão é encerrada no Logout.php e pela autenticação               

                

                $criteria = new Criteria;
                $criteria->add('id_cliente', '=', $_SESSION['id']);
                $criteria->setProperty('groupby', 'produto');
               

                $repository = new Repository('View_carrinho_de_compra');
                $obj = $repository->load($criteria); 


                $produtos = "";
    
                foreach($obj as $db) {

                    $produto = file_get_contents("Application/Templates/html/Carrinho_de_compra/Produto_do_carrinho_de_compra_li.html");

                    $preco_total = $db->quantidade * $db->preco;
                    
                    $produto = str_replace("{produto}", $db->produto, $produto);
                    $produto = str_replace("{id_produto}", $db->id_produto, $produto);
                    $produto = str_replace("{quantidade}", $db->quantidade, $produto);
                    $produto = str_replace("{preço_unitário}", $db->preco, $produto);
                    $produto = str_replace("{preço_total}", $preco_total, $produto);

                    $produtos .= $produto;
                    
                    
                }

                $carrinho_de_compra = file_get_contents("Application/Templates/html/Carrinho_de_compra/Produto_do_carrinho_de_compra_ul.html");

                $carrinho_de_compra = str_replace("{produto_do_carrinho_de_compra}", $produtos, $carrinho_de_compra);                
                

                $this->template = file_get_contents("Application/Templates/html/Home.html");

                $this->template = str_replace("{{section}}", $carrinho_de_compra, $this->template);


                Transaction::close();

            }catch(Exception $e) {

                print $e->getMessage();

                Transaction::rollback();

            }

        }


        public function show() { 
            
            parent::show();

            echo $this->template;
           

        }


        public function adicionar_Quantidade() {

            header("Location:index.php?{authentication}&class=Carrinho_de_compra");

        }


        public function diminuir_Quantidade() {            

            header("Location:index.php?{authentication}&class=Carrinho_de_compra");

        }



        public function remover_Produto() {

            


            try{

                Transaction::open('loja');


                $criteria = new Criteria;
                $criteria->add('id_cliente', '=', $_SESSION['id']);
                $criteria->add('id_produto', '=', $_GET['id_produto']);
                

                $repository = new Repository('Tabela_carrinho_de_compra');
                $repository->delete($criteria);


                Transaction::close();

                header("Location:index.php?{authentication}&class=Carrinho_de_compra");

            }catch(Expection $e) {

                print $e->getMessage();

                Transaction::rollback();

            }

            

            

            

        }



    }


?>