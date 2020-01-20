<?php

class Database {

    private $host = "localhost";
    private $db_name = "bd_pet";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection() {

        //valor inicial vazio
        $this->conn = null;
        try {
            //instanciando a variavel com valores para as variaveis privadas
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password,
                    array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        //funçao retorna a conexao com o banco de dados
        return $this->conn;
    }

}

?>