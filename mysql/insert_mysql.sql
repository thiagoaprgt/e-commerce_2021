use `loja`;

insert into `produto` (`id`, `descricao`, `estoque`, `preco_custo`, `preco_venda`, `codigo_de_barras`, `data_cadastro`)

    values 

        (null, 'Produto1', '5','5000', '12000', '123456789', '2021-05-13'),
        (null, 'Produto2', '3','200', '1500', '123452189', '2019-11-27'),
        (null, 'Produto3', '10', '1200', '7000', '883456789', '2021-04-08'),
        (null, 'Produto4', '12', '3200', '9000', '882356789', '2012-10-08')

;


INSERT INTO `cadastro_do_cliente`(`id`, `nome`, `email`, `senha`, `ddd-telefone`, `telefone`, `cidade`, `estado`, `bairro`, `rua`, `numero`, `complemento`, `cep`) VALUES

    (null, 'Pessoa1', 'p1@email', '897', '10', '123', 'São Paulo', 'São Paulo', 'bairro1', 'rua1', '123', 'casa1', '12345678'),
    (null, 'Pessoa2', 'p2@email', '787', '10', '123', 'Curitiba', 'Paraná', 'bairro', 'rua2', '456', 'casa2', '12345678'),
    (null, 'Pessoa3', 'p3@email', '997', '10', '123', 'Belo Horizonte', 'Minas Gerais', 'bairro3', 'rua3', '789', 'casa3', '12345678'),
    (null, 'Pessoa4', 'p4@email', '812', '10', '123', 'Florianópolis', 'Santa Catarina', 'bairro4', 'rua4', '147', 'casa4', '12345678')

;


-- todo o símbolo aspas, ' , que for guardado dentro do banco de dados tem ser alterado para \' senão haverá erro no registro.
-- isso acontece para que não haja sql injection

INSERT INTO `cadastro_do_conteudo`(`id`, `titulo`, `conteudo`) VALUES

    (null, 'Título1', 'What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),

    (null, 'Título2', 'Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'),

    (null, 'Título3', 'Where does it come from?
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.'),

    (null, 'Título4', 'Where can I get some?
There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.')

;
    


