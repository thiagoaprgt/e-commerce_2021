
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