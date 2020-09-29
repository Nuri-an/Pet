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
            $social = $integrantes->getSocial();
            $dataInicio = $integrantes->getDataInicio();
            $dataFim = $integrantes->getDataFim();
            $situacao = $integrantes->getSituacao();
            $foto = $integrantes->getFoto();
            $tipo = $integrantes->getTipo();

            $stmt = $this->conn->prepare("INSERT INTO integrantes(nomeIntegrante, emailIntegrante, dataInicioIntegrante, dataFimIntegrante, situacaoIntegrante, fotoIntegrante, socialIntegrante)
           VALUES (:nome, :email, :dataInicio, :dataFim, :situacao, :foto, :social)");

            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":email", $email);
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
            }else if ($tipo == 'colaborador') {
                $ultimoCod = $this->conn->lastInsertId();
                $stmt2 = $this->conn->prepare("INSERT INTO colaboradores(codIntegrante)
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
            $social = $integrantes->getSocial();
            $dataInicio = $integrantes->getDataInicio();
            $dataFim = $integrantes->getDataFim();
            $situacao = $integrantes->getSituacao();
            $foto = $integrantes->getFoto();

            $stmtFoto = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = ?");
            $stmtFoto->bindparam(1, $id);
            $stmtFoto->execute();
            $rowIntegrante = $stmtFoto->fetch(PDO::FETCH_ASSOC);

            if ($foto == '') {
                $fotoAnte =  $rowIntegrante['fotoIntegrante'];

            } else {
                $fotoAnte =  $foto;

                if(!empty($rowIntegrante['fotoIntegrante'])){
                    $caminho = "../assets/media/integrantes/" . $rowIntegrante['fotoIntegrante'];

                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }
            }

            $stmt = $this->conn->prepare("UPDATE integrantes SET nomeIntegrante = ?, emailIntegrante = ?, dataInicioIntegrante = ?, dataFimIntegrante = ?, situacaoIntegrante = ?, fotoIntegrante = ?, socialIntegrante = ? WHERE codIntegrante = ? ");

            $stmt->bindparam(1, $nome);
            $stmt->bindparam(2, $email);
            $stmt->bindparam(3, $dataInicio);
            $stmt->bindparam(4, $dataFim);
            $stmt->bindparam(5, $situacao);
            $stmt->bindparam(6, $fotoAnte);
            $stmt->bindparam(7, $social);
            $stmt->bindparam(8, $id);
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

    public function excluirFoto(ModelIntegrantes $integrantes)
    {
        try {
            //update user where idprof
            $id = $integrantes->getId();
            $foto = $integrantes->getFoto();

            $stmtNome = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = ?");
            $stmtNome->bindparam(1, $id);
            $stmtNome->execute();

            while ($rowIntegrante = $stmtNome->fetch(PDO::FETCH_ASSOC)) {

                if(!empty($rowIntegrante['fotoIntegrante'])){
                    $caminho = "../assets/media/integrantes/" . $rowIntegrante['fotoIntegrante'];
                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }
            }

            $stmt = $this->conn->prepare("UPDATE integrantes SET fotoIntegrante = ? WHERE codIntegrante = ?");
            $stmt->bindparam(1, $foto);
            $stmt->bindparam(2, $id);
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


    public function excluirIntegrante(ModelIntegrantes $integrantes)
    {
        try {
            //update user where idprof
            $id = $integrantes->getId();
            $tipo = $integrantes->getTipo();


            $stmtFoto = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = ?");
            $stmtFoto->bindparam(1, $id);
            $stmtFoto->execute();

            while ($rowIntegrante = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {

                if(!empty($rowIntegrante['fotoIntegrante'])){
                    $caminho = "../assets/media/integrantes/" . $rowIntegrante['fotoIntegrante'];
                    if (file_exists($caminho)) {
                        unlink($caminho);
                    }
                }
            }

            if ($tipo == 'discente') {
                $stmtAux = $this->conn->prepare("SELECT codDiscente FROM discentes WHERE codIntegrante = ?");
                $stmtAux->bindparam(1, $id);
                $stmtAux->execute();
                while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {
                    $idAux = $rowAuxiliar['codDiscente'];
                }
                $stmt2 = $this->conn->prepare("DELETE FROM discentes WHERE codDiscente = ?");
                $stmt2->bindparam(1, $idAux);
                $stmt2->execute();
            } else if ($tipo == 'tutor') {
                $stmtAux = $this->conn->prepare("SELECT codTutor FROM tutores WHERE codIntegrante = ?");
                $stmtAux->bindparam(1, $id);
                $stmtAux->execute();
                while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {
                    $idAux = $rowAuxiliar['codTutor'];
                }
                $stmt2 = $this->conn->prepare("DELETE FROM tutores WHERE codTutor = ?");
                $stmt2->bindparam(1, $idAux);
                $stmt2->execute();
            } else if ($tipo == 'colaborador') {
                $stmtAux = $this->conn->prepare("SELECT codColaborador FROM colaboradores WHERE codIntegrante = ?");
                $stmtAux->bindparam(1, $id);
                $stmtAux->execute();
                while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {
                    $idAux = $rowAuxiliar['codColaborador'];
                }
                $stmt2 = $this->conn->prepare("DELETE FROM colaboradores WHERE codColaborador = ?");
                $stmt2->bindparam(1, $idAux);
                $stmt2->execute();
            }

            if ($stmt2->rowCount() > 0) {
                $stmt = $this->conn->prepare("DELETE FROM integrantes WHERE codIntegrante = ?");
                $stmt->bindparam(1, $id);
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
}
