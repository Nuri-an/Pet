<?php

require_once('../database/Database.php');

class DaoAdministradores
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


    public function aceitarSolicitacao(ModelAdministradores $administradores)
    {
        try {

            $id = $administradores->getId();
            $dataAtual = date('Y-m-d');

            $stmt = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = :id");
            $stmt->execute(array(':id' => $id));
            $admRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $email = $admRow['emailIntegrante'];
            $name =  explode(' ', $admRow['nomeIntegrante'])[0];

            $stmt = $this->conn->prepare("INSERT INTO administradores(codIntegrante) VALUES (:id)");
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            $stmt2 = $this->conn->prepare("UPDATE integrantes SET dataInicioIntegrante = ? WHERE codIntegrante = ? ");
            $stmt2->bindparam(1, $dataAtual);
            $stmt2->bindparam(2, $id);
            $stmt2->execute();

            if (($stmt->rowCount() > 0) && ($stmt2->rowCount() > 0)) {
                $this->sendMail($administradores, $name, $email);
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cancelarSolicitacao(ModelAdministradores $administrador)
    {
        try {
            //update user where idprof
            $id = $administrador->getId();

            $stmt = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = :id");
            $stmt->execute(array(':id' => $id));
            $admRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $email = $admRow['emailIntegrante'];
            $name =  explode(' ', $admRow['nomeIntegrante'])[0];

            $stmt2 = $this->conn->prepare("DELETE FROM integrantes WHERE codIntegrante = ?");
            $stmt2->bindparam(1, $id);
            $stmt2->execute();
            
            if ($stmt2->rowCount() > 0) {
                $this->sendMail($administrador, $name, $email);
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function excluirPerfil(ModelAdministradores $administrador)
    {
        try {
            //update user where idprof
            $id = $administrador->getId();

            $stmt = $this->conn->prepare("SELECT codIntegrante FROM administradores WHERE codAdministrador = :id");
            $stmt->execute(array(':id' => $id));
            $idIntegrante = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt2 = $this->conn->prepare("DELETE FROM integrantes WHERE codIntegrante = ?");
            $stmt2->bindparam(1, $idIntegrante['codIntegrante']);
            $stmt2->execute();

            $stmt3 = $this->conn->prepare("DELETE FROM administradores WHERE codIntegrante = ?");
            $stmt3->bindparam(1, $idIntegrante['codIntegrante']);
            $stmt3->execute();

            if (($stmt2->rowCount() > 0) && ($stmt3->rowCount() > 0)) {
                session_start();
                session_destroy();
                unset($_SESSION['adm_session']);
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function sendMail(ModelAdministradores $login, $nameTo, $emailTo)
    {
        try {
            $id = $login->getId();
            $emailFrom = $login->getEmailFrom();
            $senhaFrom = $login->getSenhaFrom();
            $nameFrom = $login->getNameFrom();
            $msg = $login->getMsg();

            require '../assets/php-mailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            
            $mail->isSMTP(); 
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );                                     // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $emailFrom;                 // SMTP username
            $mail->Password = $senhaFrom;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->CharSet = 'UTF-8';
            $mail->setFrom($emailFrom, $nameFrom);
            $mail->addAddress($emailTo, $nameTo);
            $mail->addEmbeddedImage('../assets/media/logo-gpca.png', 'logo');

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'RE: Solicitação de acesso ao sistema';
            $mail->Body = '<div style="margin: 30px;">
                            <div class="text-center">
                                <font size=5> Olá ' . $nameTo . ', </font>
                            </div>
                            <div style="margin-top: 30px;">
                                <font size=3> 
                                    '. $msg .' 
                                </font>
                            </div>
                        </div>
                        <div style="margin-left: 300px;"> 
                            <img style="width:100px; height:90px;" src="cid:logo">
                        </div>';

            //echo $mail->send();
            if ($mail->send()) {
                echo 1;
            } else {
                echo $mail->ErrorInfo;
                echo $email;
                echo $nome;
                echo $id;
                echo $emailFrom;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
