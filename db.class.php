<?php
    class db {
        private $host = 'localhost'; //endereço db
        private $user ='root'; // user de conexão com SQL
        private $password = ''; 
        private $database = 'test'; // nome do db

        public function connect_mysql() {
            $con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            mysqli_set_charset($con, 'utf8');

            if (mysqli_connect_errno()) {
                echo "Ocorreu um erro no contato com nosso banco de dados. :(<br>".mysqli_connect_error()."Tente novamente!";
            }
            return $con;
        }
    }
?>