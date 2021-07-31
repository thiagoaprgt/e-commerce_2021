# e-commerce_2021
Atualmente estou desenvolvendo um e-commerce em PHP, link para explicação em vídeo da aplicação: 

https://youtu.be/0gknbRNpyDk

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
  
Próximas funcionalidades:   

  - Fazer o sistema de vendas no banco de dados; 

  - CRUD dos produtos    
  
  - Sistema de compra de cada produto cadastrado:
  
    - Página de produtos;
    - Carrinho de compra;
    - check out da compra;

  - Sistema de autorização com diferentes níveis de acesso ao banco de dados;
  
  - CRUD funcionários;
        
  
  



