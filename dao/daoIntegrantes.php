<?php

require_once('../database/Database.php');

class DaoIntegrantes
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


   /* public function adicionarFoto(ModelGaleria $galeria)
    {
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
    }*/

    public function atualizarInformacoes(ModelIntegrantes $integrantes)
    {
        try {
            //update user where idprof
            $id = $integrantes->getId();
            $nome = $integrantes->getNome();
            $email = $integrantes->getEmail();
            $cpf = $integrantes->getCpf();
            $social = $integrantes->getSocial();
            $dataInicio = $integrantes->getDataInicio();
            $dataFim = $integrantes->getDataFim();
            $situacao = $integrantes->getSituacao();
            $foto = $integrantes->getFoto();

            if ($foto == '') {
                $stmtFoto = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = ?");
                $stmtFoto->bindparam(1, $id);
                $stmtFoto->execute();

                while ($rowIntegrante = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {

                    $fotoAnte =  $rowIntegrante['fotoIntegrante'];
                }
            } else {
                $fotoAnte =  $foto;
            }

            $stmt = $this->conn->prepare("UPDATE integrantes SET nomeIntegrante = ?, emailIntegrante = ?, cpfIntegrante = ?, dataInicioIntegrante = ?, dataFimIntegrante = ?, situacaoIntegrante = ?, fotoIntegrante = ?, socialIntegrante = ? WHERE codIntegrante = ? ");

            $stmt->bindparam(1, $nome);
            $stmt->bindparam(2, $email);
            $stmt->bindparam(3, $cpf);
            $stmt->bindparam(4, $dataInicio);
            $stmt->bindparam(5, $dataFim);
            $stmt->bindparam(6, $situacao);
            $stmt->bindparam(7, $fotoAnte);
            $stmt->bindparam(8, $social);
            $stmt->bindparam(9, $id);
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

  /*  public function excluirFoto(ModelGaleria $galeria)
    {
        try {
            $id = $galeria->getId();

            $stmtNome = $this->conn->prepare("SELECT * FROM galeria WHERE codGaleria = ?");
            $stmtNome->bindparam(1, $id);
            $stmtNome->execute();

            while ($rowGaleria = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                $caminho = "../assets/media/galeria/" . $rowGaleria['fotoGaleria'];
                if (file_exists($caminho)) {
                    unlink($caminho);
                }
            }

            $stmt = $this->conn->prepare("DELETE FROM galeria WHERE codGaleria = ?");
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
    }*/
}
