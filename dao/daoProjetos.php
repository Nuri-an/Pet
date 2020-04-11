<?php

require_once('../database/Database.php');

class DaoProjetos
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


    public function adicionarProjeto(ModelProjetos $projeto)
    {
        try {
            $midia = $projeto->getMidia();
            $titulo = $projeto->getTitulo();
            $descricao = $projeto->getDescricao();
            $ano = $projeto->getData();
            $publicacao = $projeto->getPublicacao();
            $parceria = $projeto->getParceria();


            $stmt = $this->conn->prepare("INSERT INTO projetos(midiaProjeto, tituloProjeto, descricaoProjeto, anoProjeto, publicacaoProjeto, parceriaProjeto) 
            VALUES (:midia, :titulo, :descricao, :ano, :publicacao, :parceria)");

            $stmt->bindparam(":midia", $midia);
            $stmt->bindparam(":titulo", $titulo);
            $stmt->bindparam(":descricao", $descricao);
            $stmt->bindparam(":ano", $ano);
            $stmt->bindparam(":publicacao", $publicacao);
            $stmt->bindparam(":parceria", $parceria);
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


    public function atualizarProjeto(ModelProjetos $projeto)
    {
        try {
            $midia = $projeto->getMidia();
            $titulo = $projeto->getTitulo();
            $descricao = $projeto->getDescricao();
            $data = $projeto->getData();
            $publicacao = $projeto->getPublicacao();
            $parceria = $projeto->getParceria();
            $id = $projeto->getId();

            if ($midia != '') {
                $stmtNome = $this->conn->prepare("SELECT * FROM projetos WHERE codProjeto = ?");
                $stmtNome->bindparam(1, $id);
                $stmtNome->execute();

                while ($rowProjeto = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                    $caminho = "../assets/media/projetos/" . $rowProjeto['midiaNoticia'];
                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }

                $stmt = $this->conn->prepare("UPDATE projetos SET tituloProjeto = ?, midiaProjeto = ?, descricaoProjeto = ?, anoProjeto = ?, publicacaoProjeto =?, parceriaProjeto =? WHERE codProjeto = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $midia);
                $stmt->bindparam(3, $descricao);
                $stmt->bindparam(4, $data);
                $stmt->bindparam(5, $publicacao);
                $stmt->bindparam(6, $parceria);
                $stmt->bindparam(7, $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                $stmt = $this->conn->prepare("UPDATE projetos SET tituloProjeto = ?, descricaoProjeto = ?, anoProjeto = ?, publicacaoProjeto =?, parceriaProjeto =? WHERE codProjeto = ?  ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $descricao);
                $stmt->bindparam(3, $data);
                $stmt->bindparam(4, $publicacao);
                $stmt->bindparam(5, $parceria);
                $stmt->bindparam(6, $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 3;
                } else {
                    echo 2;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function excluirProjeto(ModelProjetos $projeto)
    {
        try {
            $id = $projeto->getId();

            $stmtNome = $this->conn->prepare("SELECT * FROM projetos WHERE codProjeto = ?");
            $stmtNome->bindparam(1, $id);
            $stmtNome->execute();

            while ($rowProjeto = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                $midia = $rowProjeto['midiaProjeto'];

                if ($midia != '') {
                    $caminho = "../assets/media/projetos/" . $midia;
                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }
            }

            $stmt = $this->conn->prepare("DELETE FROM projetos WHERE codProjeto = ?");
            $stmt->bindparam(1, $id);
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
?>