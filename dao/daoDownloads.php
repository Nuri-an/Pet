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

            if (($slides != '') && ($algoritmo != '')) {
                $stmtSlides = $this->conn->prepare("SELECT * FROM downloads WHERE codDownload = ?");
                $stmtSlides->bindparam(1, $id);
                $stmtSlides->execute();

                while ($rowDownloads = $stmtSlides->fetch(PDO::FETCH_ASSOC)) {

                    $slidesAnte =  $rowDownloads['slidesDownload'];
                    $algoritmoAnte =  $rowDownloads['algoritmoDownload'];
                    $slidesPath = "../assets/media/downloads/" . $slidesAnte;
                    $algoritmoPath = "../assets/media/downloads/" . $rowDownloads['algoritmoDownload'];
                }

                if ($slides == 'vazio') {
                    if (($slidesAnte != '') && (file_exists($slidesPath))) {
                        unlink($slidesPath);
                    }
                    $slides = '';
                } else if ($slides == 'ante') {
                    $slides = $slidesAnte;
                } else {
                    if (($slidesAnte != '') && (file_exists($slidesPath))) {
                        unlink($slidesPath);
                    }
                }

                if ($algoritmo == 'vazio') {
                    if (($algoritmoAnte != '') && (file_exists($algoritmoPath))) {
                        unlink($algoritmoPath);
                    }
                    $algoritmo = '';
                } else if ($algoritmo == 'ante') {
                    $algoritmo = $algoritmoAnte;
                } else if ($algoritmo == '') {
                    $algoritmo = '';
                } else {
                    if (($algoritmoAnte != '') && (file_exists($algoritmoPath))) {
                        unlink($algoritmoPath);
                    }
                }


                $stmt = $this->conn->prepare("UPDATE downloads SET tituloDownload = ?, referenciaDownload = ?, slidesDownload = ?, algoritmoDownload = ?, linkDownload = ? WHERE codDownload = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $referencia);
                $stmt->bindparam(3, $slides);
                $stmt->bindparam(4, $algoritmo);
                $stmt->bindparam(5, $link);
                $stmt->bindparam(6, $id);
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

    public function excluir(ModelDownloads $downloads)
    {
        try {
            //update user where idprof
            $id = $downloads->getId();

            $stmtArquivos = $this->conn->prepare("SELECT * FROM downloads WHERE codDownload = ?");
            $stmtArquivos->bindparam(1, $id);
            $stmtArquivos->execute();

            while ($rowDownloads = $stmtArquivos->fetch(PDO::FETCH_ASSOC)) {

                $slidesAnte =  $rowDownloads['slidesDownload'];
                $algoritmoAnte =  $rowDownloads['algoritmoDownload'];
                $slidesPath = "../assets/media/downloads/" . $slidesAnte;
                $algoritmoPath = "../assets/media/downloads/" . $rowDownloads['algoritmoDownload'];

                if (($slidesAnte != '') && (file_exists($slidesPath))) {
                    unlink($slidesPath);
                }
                if (($algoritmoAnte != '') && (file_exists($algoritmoPath))) {
                    unlink($algoritmoPath);
                }
            }

            $stmt = $this->conn->prepare("DELETE FROM downloads WHERE codDownload = ?");
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
