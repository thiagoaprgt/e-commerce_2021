<?php

    namespace Thiago_AP\Core;

    class ClassLoader {
        
        protected $prefixes = array();

        public function register() {

            spl_autoload_register(array($this, 'loadClass'));

        }


        public function addNamespace($prefix, $base_dir, $prepend = false) {

            /*

                a função trim() remove espaços em brancos e caracteres  da string
                
                a função rtrim() remove espaços em brancos e caracteres somente do final da string

                DIRECTORY_SEPARATOR é uma constante pré definida do php

            */

            $prefix = trim($prefix, '\\') . '\\';

            $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

            // inicializa o array de namespace

            if(isset($this->prefixes[$prefix]) === false) {

                $this->prefixes[$prefix] = array();

            }


            // retém o diretório base para o prefixo do namespace

            // array_unshift() — Adiciona um ou mais elementos no início de um array

            // array_push() - Adiciona um ou mais elementos no final de um array

            if($prepend) {

                array_unshift($this->prefixes[$prefix], $base_dir);

            }else {

                array_push($this->prefixes[$prefix], $base_dir);
            }

                        
        }

        public function loadClass($class) {

            // o atual prefixo do namespace

            $prefix = $class;

            /*

                trabalhe de trás para frente através dos nomes de 
                namespace do servidor totalmente qualificado.

                nome da classe para encontrar um nome de arquivo mapeado


            */


            /**
             * strrpos — Encontra a posição da última ocorrência de um caractere em uma string
             * a posição 0 refere-se a primeira letra da string
             * Exemplo:
             * $prefix = teste\classe
             * strrpos($prefix, '\\') irá retornar 5 porque a última ocorrência é sexta letra da string
             * strrpos($prefix, 't') irá retorna 3 porque a última ocorrência é quarta letra da string
            */            


            while(false !== $pos = strrpos($prefix, '\\')) {

                


                // substr() — Retorna uma parte de uma string


                /**
                 * substr($class, 0, pos + 1) 
                 * Exemplo
                 * $prefix receberá o nome do namespace exemplo teste\classe
                 * começará na posição 0, ou seja, na primeira letra da string nesse caso a letra t
                 * nesse exemplo (pos + 1) mostrará as 6 primeiras letras, logo será
                 * retornado a string teste\
                */
                

                // retém o prefixo do namespace
                
                $prefix = substr($class, 0, $pos + 1);

                // o resto é o nome da classe relativa

                /**
                 * substr($class, 0, pos + 1) 
                 * Exemplo
                 * $prefix receberá o nome do namespace exemplo teste\classe
                 * $pos nesse exemplo retorna o valor inteiro 5
                 * começará na posição 6 (pos + 1), ou seja, na sétima letra da string nesse caso a letra c
                 * retornando a string classe
                */

                $relative_class =  substr($class, $pos + 1);

                // Tenta carregar um arquivo mapeado para o prefixo e classe relativa

                $mapped_file = $this->loadMappedFile($prefix, $relative_class);

                if($mapped_file) {
                    return $mapped_file;
                }


                // remove o separador do namespace para a próxima iteração
                // de strrpos()
                

                $prefix = rtrim($prefix, '\\');

                /**                 
                 * Exemplo: $prefix = teste\
                 * A string retornada por rtrim($prefix, '\\') será teste
                */

            }

            // nunca encontrou um arquivo mapeado

            return false;

            
        }


        protected function loadMappedFile($prefix, $relative_class) {

            // Há algum diretório base para este prefixo de namespace?

            if(isset($this->prefixes[$prefix]) === false) {
                return false;
            }

            // procure nos diretórios base esse prefixo de namespace

            foreach($this->prefixes[$prefix] as $base_dir) {

                /*
                
                    reponha o prefixo do namespace com o diretório base
                    reponha os separadores dos namespaces com os separadores dos diretórios
                    no nome da classe relativa

                */

                $file = $base_dir . $relative_class . '.php';

                $file = str_replace('\\', '/', $file);

                // se o arquivo mapeado existe, requisite-o

                if($this->requireFile($file)) {
                    // sim, acabamos

                    return $file;

                }

            }

            // Nunca o encontrei

            return false;

        }


        protected function requireFile($file) {

            if(file_exists($file)) {

                require $file;
                return true;

            }

            return false;

        }



    }







?>