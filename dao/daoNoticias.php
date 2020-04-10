<?php

require_once('../database/Database.php');

class DaoNoticias
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

    public function adicionarNoticia(ModelNoticias $noticia)
    {
        try {
            $midia = $noticia->getMidia();
            $titulo = $noticia->getTitulo();
            $descricao = $noticia->getDescricao();
            $data = $noticia->getData();
            $local = $noticia->getLocal();


            $stmt = $this->conn->prepare("INSERT INTO noticias(midiaNoticia, tituloNoticia, descricaoNoticia, dataNoticia, localNoticia) 
            VALUES (:midia, :titulo, :descricao, :dataN, :localN)");

            $stmt->bindparam(":midia", $midia);
            $stmt->bindparam(":titulo", $titulo);
            $stmt->bindparam(":descricao", $descricao);
            $stmt->bindparam(":dataN", $data);
            $stmt->bindparam(":localN", $local);
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


    public function atualizarNoticia(ModelNoticias $noticia)
    {
        try {
            $midia = $noticia->getMidia();
            $titulo = $noticia->getTitulo();
            $descricao = $noticia->getDescricao();
            $data = $noticia->getData();
            $local = $noticia->getLocal();
            $id = $noticia->getId();

            if ($midia != '') {
                $stmtNome = $this->conn->prepare("SELECT * FROM noticias WHERE codNoticia = ?");
                $stmtNome->bindparam(1, $id);
                $stmtNome->execute();

                while ($rowNoticia = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                    $caminho = "../assets/media/noticias/" . $rowNoticia['midiaNoticia'];
                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }

                $stmt = $this->conn->prepare("UPDATE noticias SET tituloNoticia = ?, midiaNoticia = ?, descricaoNoticia = ?, dataNoticia = ?, localNoticia =? WHERE codNoticia = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $midia);
                $stmt->bindparam(3, $descricao);
                $stmt->bindparam(4, $data);
                $stmt->bindparam(5, $local);
                $stmt->bindparam(6, $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                $stmt = $this->conn->prepare("UPDATE noticias SET tituloNoticia = ?, descricaoNoticia = ?, dataNoticia = ?, localNoticia =? WHERE codNoticia = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $descricao);
                $stmt->bindparam(3, $data);
                $stmt->bindparam(4, $local);
                $stmt->bindparam(5, $id);
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

    public function excluirNoticia(ModelNoticias $noticia)
    {
        try {
            $id = $noticia->getId();

            $stmtNome = $this->conn->prepare("SELECT * FROM noticias WHERE codNoticia = ?");
            $stmtNome->bindparam(1, $id);
            $stmtNome->execute();

            while ($rowNoticia = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                $midia = $rowNoticia['midiaNoticia'];

                if ($midia != '') {
                    $caminho = "../assets/media/noticias/" . $midia;
                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }
            }

            $stmt = $this->conn->prepare("DELETE FROM noticias WHERE codNoticia = ?");
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
