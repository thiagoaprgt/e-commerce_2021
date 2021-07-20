
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
    `ddd-telefone` int(3) not null,
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