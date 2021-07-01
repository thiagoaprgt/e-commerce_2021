<?php

    namespace Thiago_AP\Database;

    use PDO;
    use Exception;

    // Cria conexões com o banco de dados

    // desing pattern factory


    final class Connection {        

        // Não podem existir instâncias de Connection

        private function __construct($conn) {}

        /**
         * Recebe o nome do conector do banco de dados e instancia o objeto PDO
        */

        public static function open($name) {

            /**
             * Verifica se existe um arquivo de configuração para este banco de
             * dados
            */

            if(file_exists("Application/Config/{$name}.ini")) {

                // lê o INI e retorna um array

                $db = parse_ini_file("Application/Config/{$name}.ini");

            }else {

                // Se não existir, lança um erro

                throw new Exception("Arquivo $name não encontrado");

            }

            // lê as informações contidas no arquivo

            $user = isset($db['user']) ? $db['user'] : NULL;
            $pass = isset($db['pass']) ? $db['pass'] : NULL;
            $name = isset($db['name']) ? $db['name'] : NULL;
            $host = isset($db['name']) ? $db['name'] : NULL;
            $type = isset($db['type']) ? $db['type'] : NULL;
            $port = isset($db['port']) ? $db['port'] : NULL;

            // descobre qual o tipo (driver) de banco de dados a ser utilizado

            switch($type) {

                case 'pgsql':
                    $port = $port ? $port : '5432';
                    $conn = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass}; host={$host}; port={$port}");
                break;

                case 'mysql':
                    $port = $port ? $port : '3306';
                    $conn = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
                break;

                case 'sqlite':
                    $conn = new PDO("sqlite:{$name}");
                    $conn->query('PRAGMA foreign_keys = ON');
                break;

                case 'ibase':
                    $conn = new PDO("firebird:dbname={$name}", $user, $pass);
                break;

                case 'oci8':
                    $conn = new PDO("oci:dbname={$name}", $user, $pass);
                break;

                case 'mssql':
                    $conn = new PDO("dblib:host={$host}:{$port};dbname={$name}", $user, $pass);
                break;

            }

            // Define para que o PDO lance exceções na ocorrência de erros

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            
        }

    }

?>