<?php

    use Thiago_AP\Control\Page;
    use Thiago_AP\Database\Transaction;    
    use Thiago_AP\Database\Criteria;
    use Thiago_AP\Database\Repository;


    class Carrinho_de_compra extends Page {

        private $template;

        
        public function __construct() {

            try{

                if(empty($_SESSION)) {

                    // Caso o cliente tentar acessar a página do carrinho_de_compra sem estar logado

                    header("Location:index.php?class=Login");
                    
                }

                Transaction::open("loja");

                // a sessão é iniciada no index.php
                // a sessão é encerrada no Logout.php e pela autenticação  
                

                $criteria = new Criteria;
                $criteria->add('id_cliente', '=', $_SESSION['id']);
                $criteria->setProperty('groupby', 'produto');
                
                
                $repository = new Repository('View_carrinho_de_compra');

                $columns[] = 'id_cliente';
                $columns[] = 'produto';
                $columns[] = 'id_produto';
                $columns[] = 'sum(quantidade) as quantidade';
                $columns[] = 'preco';

                $obj = $repository->load($criteria, $columns); 


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

            try{

                Transaction::open('loja');


                $criteria = new Criteria;
                $criteria->add('id_cliente', '=', $_SESSION['id']);
                $criteria->add('id_produto', '=', $_GET['id_produto']);

                $carrinho_de_compra = new Tabela_carrinho_de_compra;

                $carrinho_de_compra->id_cliente = $_SESSION['id'];
                $carrinho_de_compra->id_produto = $_GET['id_produto'];
                $carrinho_de_compra->quantidade = 1;

                $carrinho_de_compra->store();  

                Transaction::close();

                header("Location:index.php?authentication=" . $_SESSION['authentication'] . "&class=Carrinho_de_compra");
                

            }catch(Expection $e) {

                print $e->getMessage();

                Transaction::rollback();

            }
            

        }


        public function diminuir_Quantidade() {            

            try{

                Transaction::open('loja');

                //DELETE FROM `carrinho_de_compra` WHERE id_cliente=1 and id_produto=3 order by id desc limit 1.
                // irá deletar apenas um registro por causa do operador SQL limit.
                // o registro deletado será o que tiver o maior id por causa do operador desc que ordenou de forma decrescente.

                $criteria = new Criteria;
                $criteria->add('id_cliente', '=', $_SESSION['id']);
                $criteria->add('id_produto', '=', $_GET['id_produto']);
                
                $criteria->setProperty('order', 'id desc');
                $criteria->setProperty('limit', '1');                                 

                $repository = new Repository('Tabela_carrinho_de_compra');
                $repository->delete($criteria);   

                Transaction::close();

                header("Location:index.php?authentication=" . $_SESSION['authentication'] . "&class=Carrinho_de_compra");
                                

            }catch(Expection $e) {

                print $e->getMessage();

                Transaction::rollback();

            }

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

                header("Location:index.php?authentication=" . $_SESSION['authentication'] . "&class=Carrinho_de_compra");

            }catch(Expection $e) {

                print $e->getMessage();

                Transaction::rollback();

            }

            

            

            

        }



    }


?>