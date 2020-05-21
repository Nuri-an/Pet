<?php


require_once('../database/Database.php');

class DaoDownloads
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


    public function adicionar(ModelDownloads $downloads)
    {
        try {

            $titulo = $downloads->getTitulo();
            $referencia = $downloads->getReferencia();
            $slides = $downloads->getSlides();
            $algoritmo = $downloads->getAlgoritmo();
            $link = $downloads->getLink();

            $stmt = $this->conn->prepare("INSERT INTO downloads(tituloDownload, referenciaDownload, slidesDownload, algoritmoDownload, linkDownload)
           VALUES (:titulo, :referencia, :slides, :algoritmo, :link)");

            $stmt->bindparam(":titulo", $titulo);
            $stmt->bindparam(":referencia", $referencia);
            $stmt->bindparam(":slides", $slides);
            $stmt->bindparam(":algoritmo", $algoritmo);
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

    public function atualizar(ModelDownloads $downloads)
    {
        try {
            //update user where idprof
            $id = $downloads->getId();
            $titulo = $downloads->getTitulo();
            $referencia = $downloads->getReferencia();
            $slides = $downloads->getSlides();
            $algoritmo = $downloads->getAlgoritmo();
            $link = $downloads->getLink();

            $stmtSlides = $this->conn->prepare("SELECT * FROM downloads WHERE codDownload = ?");
            $stmtSlides->bindparam(1, $id);
            $stmtSlides->execute();

            while ($rowDownloads = $stmtSlides->fetch(PDO::FETCH_ASSOC)) {

                $slidesAnte =  $rowDownloads['slidesDownload'];
                $algoritmoAnte =  $rowDownloads['algoritmoDownload'];
            }

            if (!($slides == '')) {
                $slidesAnte =  $slides;
            } 
            if (!($algoritmo == '')) {
                $algoritmoAnte =  $algoritmo;
            }

            $stmt = $this->conn->prepare("UPDATE downloads SET tituloDownload = ?, referenciaDownload = ?, slidesDownload = ?, algoritmoDownload = ?, linkDownload = ? WHERE codDownload = ? ");

            $stmt->bindparam(1, $titulo);
            $stmt->bindparam(2, $referencia);
            $stmt->bindparam(3, $slidesAnte);
            $stmt->bindparam(4, $algoritmoAnte);
            $stmt->bindparam(5, $link);
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

    public function excluir(ModelDownloads $downloads)
    {
        try {
            //update user where idprof
            $id = $downloads->getId();

            $stmtArquivos = $this->conn->prepare("SELECT * FROM downloads WHERE codDownload = ?");
            $stmtArquivos->bindparam(1, $id);
            $stmtArquivos->execute();

            while ($rowDownloads = $stmtArquivos->fetch(PDO::FETCH_ASSOC)) {

                $slides = "../assets/media/downloads/" . $rowDownloads['slidesDownload'];
                $algoritmo = "../assets/media/downloads/" . $rowDownloads['algoritmoDownload'];

                if (file_exists($slides)) {
                    unlink($slides);
                }
                if (file_exists($algoritmo)) {
                    unlink($algoritmo);
                }
            }

            $stmt = $this->conn->prepare("DELETE FROM downloads WHERE codDownload = ?");
            $stmt->bindparam(1, $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 1;
            }else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
?>