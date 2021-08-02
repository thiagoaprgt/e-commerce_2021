
create database `loja`;

use `loja`;

create table `produto` (

    `id` int(5) primary key not null auto_increment,
    `descricao` varchar(30),
    `estoque` int(5),
    `preco_custo` int(5),
    `preco_venda` int(5),
    `codigo_de_barras` int(20),
    `data_cadastro` date


);



create table `cadastro_do_cliente` (

    `id` int(5) primary key not null auto_increment,
    `nome` text(30) not null,
    `email` varchar(30) not null unique,
    `senha` varchar(30) not null,
    `ddd_telefone` int(3) not null,
    `telefone` int(9),
    `cidade` text(30) not null,
    `estado` text(30) not null,
    `bairro` text(30) not null,
    `rua` text(30) not null,
    `numero` int(5) not null,
    `complemento` varchar(40) not null,
    `cep` int(7) not null


);

-- todo o símbolo aspas, ' , que for guardado dentro do banco de dados tem ser alterado para \' senão haverá erro no registro.
-- isso acontece para que não haja sql injection

create table `cadastro_do_conteudo` (

    `id` int(5) primary key not null auto_increment,
    `titulo` varchar(30) not null,
    `conteudo` varchar(3000) not null,
    `data_do_cadastro` date not null

);


create table `carrinho_de_compra` (

    `id` int(5) primary key not null auto_increment,
    
    `id_cliente` int(5) not null,
    FOREIGN KEY (id_cliente) REFERENCES cadastro_do_cliente(id),

    `id_produto` int(5) not null,
    FOREIGN KEY (id_produto) REFERENCES produto(id),   

    `quantidade` int(5) not null

);


-- criando uma view do carrinho de compra
-- a tabela no from tem que ter as foreign key das tabelas do inner join

create view view_carrinho_de_compra AS
SELECT carrinho_de_compra.id, cadastro_do_cliente.id as id_cliente,  cadastro_do_cliente.nome as cliente, produto.id as id_produto, produto.descricao as produto, produto.preco_venda as preco, carrinho_de_compra.quantidade as quantidade

from carrinho_de_compra

INNER JOIN cadastro_do_cliente
ON carrinho_de_compra.id_cliente = cadastro_do_cliente.id

INNER JOIN produto
ON carrinho_de_compra.id_produto = produto.id;


-- Finalizada com sucesso a view do carrinho de compra

--teste view

create view view_carrinho_de_compra AS
SELECT cadastro_do_cliente.id as id, cadastro_do_cliente.nome as cliente, produto.descricao as produto, produto.preco_venda as preco, sum(carrinho_de_compra.quantidade) as quantidade

from carrinho_de_compra

INNER JOIN cadastro_do_cliente
ON carrinho_de_compra.id_cliente = cadastro_do_cliente.id

INNER JOIN produto
ON carrinho_de_compra.id_produto = produto.id

group by produto