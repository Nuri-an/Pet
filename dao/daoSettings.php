<?php

require_once('../database/Database.php');

class DaoSettings
{

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function editarSettings(ModelSettings $settings)
    {
        try {
            $capa = $settings->getCapa();
            $facebook = $settings->getFacebook();
            $instagram = $settings->getInstagram();
            $rodape = $settings->getRodape();

            $stmtNome = $this->conn->prepare("SELECT * FROM configuracoes WHERE 1");
            $stmtNome->execute();

            while ($rowSettings = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                $capaAnte =  $rowSettings['capa'];
                $capaPath = "../assets/media/" . $capaAnte;
            }
            if ($capa == '') {
                $capa = $capaAnte;

            } else if ((strtolower($capa) != strtolower($capaAnte)) && (file_exists($capaPath))){
                unlink($capaPath);
                echo 0;
            }

            $stmt = $this->conn->prepare("UPDATE configuracoes SET capa = ?, facebook = ?, instagram = ?, rodape = ? WHERE 1 ");

            $stmt->bindparam(1, $capa);
            $stmt->bindparam(2, $facebook);
            $stmt->bindparam(3, $instagram);
            $stmt->bindparam(4, $rodape);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
