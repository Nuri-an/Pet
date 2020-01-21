<?php

require_once('../database/Database.php');

class DaoGaleria {

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

    
    public function adicionarFoto(ModelGaleria $galeria) {
        try {
            $foto = $galeria->getFoto();
            $titulo = $galeria->getTitulo();
        
    
            $stmt = $this->conn->prepare("INSERT INTO galeria(fotoGaleria, tituloGaleria) 
            VALUES (:foto, :titulo)");
                
            $stmt->bindparam(":foto", $foto);
            $stmt->bindparam(":titulo", $titulo);
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

    public function atualizarFoto(ModelGaleria $galeria) {
        try {
            //update user where idprof
            $id = $galeria->getId();
            $titulo = $galeria->getTitulo();
            $foto = $galeria->getFoto();

            if($foto != ''){ 
                $stmtNome = $this->conn->prepare("SELECT * FROM galeria WHERE codGaleria = ?");
                $stmtNome->bindparam(1, $id);
                $stmtNome->execute();

                while ($rowGaleria = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                    $caminho = "../assets/media/galeria/". $rowGaleria['fotoGaleria'];
                    if(file_exists($caminho)){
                        unlink($caminho);
                    }
                }

                $stmt = $this->conn->prepare("UPDATE galeria SET tituloGaleria = ?, fotoGaleria = ? WHERE codGaleria = ? ");

                $stmt->bindparam(1, $titulo);
                $stmt->bindparam(2, $foto);
                $stmt->bindparam(3, $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                echo 1;
                } else {
                echo 2;
                }
            }
            else{
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

    public function excluirFoto(ModelGaleria $galeria) {
        try {
            $id = $galeria->getId();

            $stmtNome = $this->conn->prepare("SELECT * FROM galeria WHERE codGaleria = ?");
            $stmtNome->bindparam(1, $id);
            $stmtNome->execute();

            while ($rowGaleria = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                $caminho = "../assets/media/galeria/". $rowGaleria['fotoGaleria'];
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
?>