# e-commerce_2021
Atualmente estou desenvolvendo um e-commerce em PHP.

Link do youtube para a explicação desse projeto:

Parte 1: https://youtu.be/0gknbRNpyDk

Parte 2: ainda não foi feito.

Caso você queira testar o sistema eu deixei os comandos para criação do banco de dados e das tabelas MySQL aqui nesse meu Git Hub.

Link para criação das tabelas no MySQL:
https://github.com/thiagoaprgt/e-commerce_2021/blob/main/mysql/banco_de_dados_mysql.sql

Link para criação dos inserts das tabelas no MySQL, deve-se criar as tabelas antes de executar os comando de insert:
https://github.com/thiagoaprgt/e-commerce_2021/blob/main/mysql/insert_mysql.sql


Nesse projeto já tem algumas funcionalidades implementadas como:

  - Login para cada pessoa cadastrada;
  
  - Autenticação do login;
  
  - Expiração da autenticação, forçando a pessoa a fazer o login novamente depois de um determinado tempo. Essa funcionalidade foi implementada para evitar que a conta fique logada caso a pessoa esqueça de sair da conta;
  
  - Na conexão com o banco de dados foi usado o padrão de projeto Factory afim de otimizar a manutenção do sistema caso haja uma mudança nas informações usadas na conexão com o banco de dados, pois só será preciso alterar as informações em um único arquivo que automaticamente todas as chamadas de conexão com o banco de dados nos outros arquivos se alterarão;
  
  - Paginação dos artigos cadastrados no banco de dados MySQL foi feita através do Padrão de Projeto Repository, usado para manipular coleções de objetos. O comando SQL usado na paginação foi o Select com os operadores order by, limit e offset;
  
  - Centralização das instâncias dos objetos crontroladores no arquivo index foi feita usando o padrão de projeto Front Controller;
  
  - Na interpretação dos métodos de cada controlador do projeto foi usado o padrão de projeto Page Controller, cujo objetivo é interpretar as query strings, ou seja, os parâmetros passados via URL (GET) através do método nativo do PHP call_user_func();
  
  - Persistência de objetos e atualização no banco de dados foi adotado o padrão de projeto Active Record;
  
  - Responsividade através do CSS;

  - Listagem dos produtos cadastrados no banco de dados.

  - Foi abstraído o recurso de paginação criado no Home.php para ser reaproveitado, para não ficar repetindo o mesmo código várias vezes (D.R.Y. = Don't repeat yourself). Agora a paginação se tornou uma classe da biblioteca da aplicação;

  - Cadastro da conta do cliente;

  - Página de produtos;
  
   - Carrinho de compra (listagem dos produtos no carrinho usando o operador SQL group by, remoção dos produtos no carrinho)
  
Próximas funcionalidades:   
    
  - Adicionar novos produtos ao carrinho de compra;

  - Fazer o sistema de vendas no banco de dados;   
  
  - Sistema de compra de cada produto cadastrado:    
    
    - Carrinho de compra (adicionar quantidade de produtos e diminuir quantidade de produtos);

    - Fazer uma trigger no banco de banco que diminua a quantidade comprada do quantidade no estoque quando uma compra for concluída.
    
    - check out da compra;

  - Sistema de autorização com diferentes níveis de acesso ao banco de dados;
  
  - CRUD funcionários.
        
  
  



