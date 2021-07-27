# e-commerce_2021
Atualmente estou desenvolvendo um e-commerce em PHP, nesse projeto já tem algumas funcionalidades implementadas como:

  -Login para cada pessoa cadastrada;
  
  -Autenticação do login;
  
  -Expiração da autenticação, forçando a pessoa a fazer o login novamente depois de um determinado tempo. Essa funcionalidade foi implementada para evitar que a conta fique logada caso a pessoa esqueça de sair da conta;
  
  -Na conexão com o banco de dados foi usado o padrão de projeto Factory afim de otimizar a manutenção do sistema caso haja uma mudança nas informações usadas na conexão com o banco de dados, pois só será preciso alterar as informações em um único arquivo que automaticamente todas as chamadas de conexão com o banco de dados nos outros arquivos se alterarão;
  
  -Paginação dos artigos cadastrados no banco de dados MySQL foi feita através do Padrão de Projeto Repository, usado para manipular coleções de objetos. Os comandos SQL usados na paginação foram Select, order by, limit e offset;
  
  -Centralização das instâncias dos objetos crontroladores no arquivo index foi feita usando o padrão de projeto Front Controller;
  
  -Na interpretação dos métodos de cada controlador do projeto foi usado o padrão de projeto Page Controller, cujo objetivo é interpretar as query strings, ou seja, os parâmetros passados via URL (GET) através do método nativo do PHP call_user_func();
  
  -Persistência de objetos e atualização no banco de dados foi adotado o padrão de projeto Active Record;
  
  -Responsividade através do CSS


Próximas funcionalidades: 

  - Adicionar interação entre a tabela de títulos e a tabela de produtos através da foreign key;

  - CRUD dos produtos

  - CRUD dos clientes;  
  
  - Sistema de vendas de cada produto cadastro:
  
    - Página de produtos;
    - Carrinho de compra;
    - check out da compra;

  - Sistema de autorização com diferentes níveis de acesso ao banco de dados;
  
  - CRUD funcionários;
        
  
  



