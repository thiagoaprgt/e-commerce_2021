<?php


    namespace Thiago_AP\Database;

    /**
     * Fornece os métodos necessários manipular transações
    */

    final class Transaction {

        private static $conn; // conexão ativa

        /**
         * Private para impedir que se crie instâncias de Transaction
        */

        private function __construct() {}

        /**
         * Abre uma transação e uma conexão ao banco de dados
        */

        public static function open($database) {

            if(empty(self::$conn)) {

                self::$conn = Connection::open($database);

                // inicia a transação
                self::$conn->beginTransaction();                

            }

        }

        /**
         * Retorna a conexão ativa da transação
        */

        public static function get() {

            // retorna a conexão ativa

            return self::$conn;

        }

        /**
         * Desfaz todas as operações realizadas na transação
        */

        public static function rollback() {

            if (self::$conn) {

                // desfaz as operações realizadas durante a transação

                self::$conn->rollback();
                self::$conn = NULL;

            }

        }

        /**
         * Aplica todas as operações realizadas e fecha a transação
        */

        public static function close() {

            if (self::$conn) {

                // aplica as operações realizadas durante a transação
                self::$conn->commit();
                self::$conn = NULL;

            }

        }

    }



?>