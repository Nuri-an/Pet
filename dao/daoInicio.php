<?php

require_once('../database/Database.php');

class DaoInicio
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

    public function atualizarInformacoes(ModelInicio $Informacoes)
    {
        try {
            //update user where idprof
            $id = $Informacoes->getId();
            $tituloP = $Informacoes->getTituloP();
            $infoP = $Informacoes->getInfoP();
            $tituloS = $Informacoes->getTituloS();
            $infoS = $Informacoes->getInfoS();
            $extra = $Informacoes->getExtra();

            $stmt = $this->conn->prepare("UPDATE informacoes SET tituloInfo = ?, descricaoInfo = ?, subTituloInfo = ?, subDescricaoInfo = ?, extrasInfo = ? WHERE codInfo = ? ");

            $stmt->bindparam(1, $tituloP);
            $stmt->bindparam(2, $infoP);
            $stmt->bindparam(3, $tituloS);
            $stmt->bindparam(4, $infoS);
            $stmt->bindparam(5, $extra);
            $stmt->bindparam(6, $id);
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

    public function atualizarMidia(ModelInicio $galeria)
    {
        try {
            //update user where idprof
            $id = $galeria->getId();
            $titulo = $galeria->getTitulo();
            $midia = $galeria->getMidia();

            if ($midia != '') {
                $stmtNome = $this->conn->prepare("SELECT * FROM galeria WHERE codGaleria = ?");
                $stmtNome->bindparam(1, $id);
                $stmtNome->execute();

                while ($rowGaleria = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                    $caminho = "../assets/media/galeria/" . $rowGaleria['midiaGaleria'];
                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }

                $stmt = $this->conn->prepare("UPDATE galeria SET tituloGaleria = ?, midiaGaleria = ? WHERE codGaleria = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $midia);
                $stmt->bindparam(3, $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                $stmt = $this->conn->prepare("UPDATE galeria SET tituloGaleria = ? WHERE codGaleria = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $id);
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


    public function adicionarMidia(ModelInicio $galeria)
    {
        try {
            $midia = $galeria->getMidia();
            $titulo = $galeria->getTitulo();


            if ($midia != '') {
                $stmt = $this->conn->prepare("INSERT INTO galeria(midiaGaleria, tituloGaleria) 
                                                VALUES (:midia, :titulo)");

                $stmt->bindparam(":midia", $midia);
                $stmt->bindparam(":titulo", $titulo);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 1;
                }
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function excluirMidia(ModelInicio $galeria) {
        try {
            $id = $galeria->getId();

            $stmtNome = $this->conn->prepare("SELECT * FROM galeria WHERE codGaleria = ?");
            $stmtNome->bindparam(1, $id);
            $stmtNome->execute();

            while ($rowGaleria = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                $caminho = "../assets/media/galeria/". $rowGaleria['midiaGaleria'];
                if(file_exists($caminho)){
                    unlink($caminho);
                }
            }

            $stmt = $this->conn->prepare("DELETE FROM galeria WHERE codGaleria = ?");
            $stmt->bindparam(1, $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0 ) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        

    }
}
