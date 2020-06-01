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
            $resumo = $noticia->getResumo();


            $stmt = $this->conn->prepare("INSERT INTO noticias(midiaNoticia, tituloNoticia, descricaoNoticia, dataNoticia, resumoNoticia) 
            VALUES (:midia, :titulo, :descricao, :dataN, :resumo)");

            $stmt->bindparam(":midia", $midia);
            $stmt->bindparam(":titulo", $titulo);
            $stmt->bindparam(":descricao", $descricao);
            $stmt->bindparam(":dataN", $data);
            $stmt->bindparam(":resumo", $resumo);
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
            $resumo = $noticia->getResumo();
            $id = $noticia->getId();

            if ($midia != '') {
                $stmtNome = $this->conn->prepare("SELECT * FROM noticias WHERE codNoticia = ?");
                $stmtNome->bindparam(1, $id);
                $stmtNome->execute();

                while ($rowNoticia = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                    $midiaAnte =  $rowNoticia['midiaNoticia'];
                    $midiaPath = "../assets/media/noticias/" . $midiaAnte;
                }

                if ($midia == 'vazio') {
                    if (($midiaAnte != '') && (file_exists($midiaPath))) {
                        unlink($midiaPath);
                    }
                    $midia = '';
                } else if ($midia == 'ante') {
                    $midia = $midiaAnte;
                } else {
                    if (($midiaAnte != '') && (file_exists($midiaPath))) {
                        unlink($midiaPath);
                    }
                }


                $stmt = $this->conn->prepare("UPDATE noticias SET tituloNoticia = ?, midiaNoticia = ?, descricaoNoticia = ?, dataNoticia = ?, resumoNoticia =? WHERE codNoticia = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $midia);
                $stmt->bindparam(3, $descricao);
                $stmt->bindparam(4, $data);
                $stmt->bindparam(5, $resumo);
                $stmt->bindparam(6, $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 1;
                }else{
                    echo $midia;
                }
            } else {
                    echo 2;
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
