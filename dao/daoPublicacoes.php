<?php

require_once('../database/Database.php');

class DaoPublicacoes
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

    public function adicionarPublicacao(ModelPublicacoes $publicacao)
    {
        try {
            $descricao = $publicacao->getDescricao();
            $data = $publicacao->getData();
            $link = $publicacao->getLink();

            $stmt = $this->conn->prepare("INSERT INTO publicacoes(descricaoPublicacao, dataPublicacao, linkPublicacao) 
            VALUES (:descricao, :dataN, :link)");

            $stmt->bindparam(":descricao", $descricao);
            $stmt->bindparam(":dataN", $data);
            $stmt->bindparam(":link", $link);
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


    public function atualizarPublicacao(ModelPublicacoes $publicacao)
    {
        try {
            $descricao = $publicacao->getDescricao();
            $data = $publicacao->getData();
            $link = $publicacao->getLink();
            $id = $publicacao->getId();

        
                $stmt = $this->conn->prepare("UPDATE publicacoes SET descricaoPublicacao = ?, dataPublicacao = ?, linkPublicacao =? WHERE codPublicacao = ? ");

                $stmt->bindparam(1, $descricao);
                $stmt->bindparam(2, $data);
                $stmt->bindparam(3, $link);
                $stmt->bindparam(4, $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 3;
                } else {
                    echo 2;
                }
            }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function excluirPublicacao(ModelPublicacoes $publicacao)
    {
        try {
            $id = $publicacao->getId();

            $stmt = $this->conn->prepare("DELETE FROM publicacoes WHERE codPublicacao = ?");
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