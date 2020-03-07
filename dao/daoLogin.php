<?php

require_once('../database/Database.php');

class DaoLogin {

    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function logarAdm(ModelLogin $login) {
        try {

            $cpf = $login->getCpf();
            $senha = $login->getSenha();

            // $senhaCriptografada = hash('sha512', md5($senha));

            $stmt = $this->conn->prepare("SELECT * FROM integrantes i, administradores a WHERE a.codIntegrante = i.codIntegrante AND i.cpfIntegrante = :cpf");
            $stmt->execute(array(':cpf' => $cpf));
            $admRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {
                if ($senha == $admRow['senhaIntegrante']) {
                    session_start();
                    $_SESSION['adm_session'] = $admRow['codAdministrador'];
                        echo 0;
                    }
                else {
                    echo 1;
                }
            }else{
                echo 2;
            } 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*public function is_loggedin() {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirecionar($url) {
        header("Location: $url");
    }*/



}

?>