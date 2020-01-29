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


    public function adicionarInformacoes(ModelIntegrantes $integrantes)
    {
        try {

            $nome = $integrantes->getNome();
            $email = $integrantes->getEmail();
            $cpf = $integrantes->getCpf();
            $social = $integrantes->getSocial();
            $dataInicio = $integrantes->getDataInicio();
            $dataFim = $integrantes->getDataFim();
            $situacao = $integrantes->getSituacao();
            $foto = $integrantes->getFoto();
            $tipo = $integrantes->getTipo();

            $stmt = $this->conn->prepare("INSERT INTO integrantes(nomeIntegrante, emailIntegrante, cpfIntegrante, dataInicioIntegrante, dataFimIntegrante, situacaoIntegrante, fotoIntegrante, socialIntegrante)
           VALUES (:nome, :email, :cpf, :dataInicio, :dataFim, :situacao, :foto, :social)");

            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":cpf", $cpf);
            $stmt->bindparam(":dataInicio", $dataInicio);
            $stmt->bindparam(":dataFim", $dataFim);
            $stmt->bindparam(":situacao", $situacao);
            $stmt->bindparam(":foto", $foto);
            $stmt->bindparam(":social", $social);
            $stmt->execute();

            if ($tipo == 'discente') {
                $ultimoCod = $this->conn->lastInsertId();
                $stmt2 = $this->conn->prepare("INSERT INTO discentes(codIntegrante)
                VALUES (:id)");
                $stmt2->bindparam(":id", $ultimoCod);
                $stmt2->execute();
            } else if ($tipo == 'tutor') {
                $ultimoCod = $this->conn->lastInsertId();
                $stmt2 = $this->conn->prepare("INSERT INTO tutores(codIntegrante)
                VALUES (:id)");
                $stmt2->bindparam(":id", $ultimoCod);
                $stmt2->execute();
            }

            if (($stmt->rowCount() > 0) && ($stmt2->rowCount() > 0)) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

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
