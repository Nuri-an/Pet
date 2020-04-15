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

            $stmt = $this->conn->prepare("INSERT INTO administradores(codIntegrante) VALUES (:id)");
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            $stmt2 = $this->conn->prepare("UPDATE integrantes SET dataInicioIntegrante = ? WHERE codIntegrante = ? ");
            $stmt2->bindparam(1, $dataAtual);
            $stmt2->bindparam(2, $id);
            $stmt2->execute();

            if (($stmt->rowCount() > 0) && ($stmt2->rowCount() > 0)) {
                $stmt3 = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = :id");
                $stmt3->execute(array(':id' => $id));
                $admNewRow = $stmt3->fetch(PDO::FETCH_ASSOC);

                $email = $admNewRow['emailIntegrante'];
                $nome =  explode(' ', $admNewRow['nomeIntegrante'])[0];

                require '../_php-mailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp-mail.outlook.com; smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'contatonfm@outlook.com.br';                 // SMTP username
                $mail->Password = 'contato123';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->CharSet = 'UTF-8';
                $mail->setFrom('contatonfm@outlook.com.br', 'PET - Programa de Educação Tutorial');
                $mail->addAddress($email, $nome);
                $mail->addEmbeddedImage('../assets/media/logo_original.png', 'logo');

                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'RE: Solicitação de acesso ao sistema';
                $mail->Body = '<div style="margin: 30px;">
                            <div class="text-center">
                                <font size=5> Olá ' . $nome . ', </font>
                            </div>
                            <div style="margin-top: 30px;">
                                <font size=3> 
                                    Sua solicitação de acesso a área administrativa foi analisada e <b> aceita </b> por um dos atuais administradores. A partir de agora você poderá acessa a plataforma pala aba `Login` com seu CPF e senha cadastrados. 
                                </font>
                            </div>
                        </div>
                        <div style="margin-left: 300px;"> 
                            <img style="width:100px; height:60px;" src="cid:logo">
                        </div>';

                if ($mail->send()) {
                    echo 1;
                } else {
                    echo $mail->ErrorInfo;
                }
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

            $stmt = $this->conn->prepare("DELETE FROM integrantes WHERE codIntegrante = ?");
            $stmt->bindparam(1, $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $stmt3 = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = :id");
                $stmt3->execute(array(':id' => $id));
                $admNewRow = $stmt3->fetch(PDO::FETCH_ASSOC);

                $email = $admNewRow['emailIntegrante'];
                $nome =  explode(' ', $admNewRow['nomeIntegrante'])[0];

                require '../_php-mailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp-mail.outlook.com; smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'contatonfm@outlook.com.br';                 // SMTP username
                $mail->Password = 'contato123';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->CharSet = 'UTF-8';
                $mail->setFrom('contatonfm@outlook.com.br', 'PET - Programa de Educação Tutorial');
                $mail->addAddress($email, $nome);
                $mail->addEmbeddedImage('../assets/media/logo_original.png', 'logo');

                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'RE: Solicitação de acesso ao sistema';
                $mail->Body = '<div style="margin: 30px;">
                            <div class="text-center">
                                <font size=5> Olá ' . $nome . ', </font>
                            </div>
                            <div style="margin-top: 30px;">
                                <font size=3> 
                                    Sua solicitação de acesso a área administrativa foi analisada e <b> recusada </b> por um dos atuais administradores. Para mais esclarecimentos entre contato com o grupo através das informações forneciadas no rodapé do site. 
                                </font>
                            </div>
                        </div>
                        <div style="margin-left: 300px;"> 
                            <img style="width:100px; height:60px;" src="cid:logo">
                        </div>';

                if ($mail->send()) {
                    echo 1;
                } else {
                    echo $mail->ErrorInfo;
                }
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
