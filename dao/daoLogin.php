<?php

require_once('../database/Database.php');

class DaoLogin
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

    public function logarAdm(ModelLogin $login)
    {
        try {

            $cpf = $login->getCpf();
            $senha = md5($login->getSenha());

            // $senhaCriptografada = hash('sha512', md5($senha));

            $stmt = $this->conn->prepare("SELECT * FROM integrantes i, administradores a WHERE a.codIntegrante = i.codIntegrante AND i.cpfIntegrante = :cpf");
            $stmt->execute(array(':cpf' => $cpf));
            $admRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {
                if ($senha == $admRow['senhaIntegrante']) {
                    session_start();
                    $_SESSION['adm_session'] = $admRow['codAdministrador'];
                    echo 0;
                } else {
                    echo $admRow['codIntegrante'];
                }
            } else {
                $stmt2 = $this->conn->prepare("SELECT * FROM integrantes WHERE cpfIntegrante = :cpf");
                $stmt2->execute(array(':cpf' => $cpf));

                if ($stmt2->rowCount() == 1) {
                    echo 3;
                } else {
                    echo 2;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function sendMail(ModelLogin $login)
    {
        try {
            $id = $login->getId();

            $stmt = $this->conn->prepare("SELECT * FROM integrantes WHERE codIntegrante = :id");
            $stmt->execute(array(':id' => $id));
            $admRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $codigo = rand(1000, 9999);
            session_start();
            $_SESSION['id_redefinir_senha'] = $id;
            $_SESSION['cod_redefinir_senha'] = $codigo;
            $email = $admRow['emailIntegrante'];
            $nome =  explode(' ', $admRow['nomeIntegrante'])[0];

            require '../assets/php-mailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp-mail.outlook.com; smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'gpca.recovery@gmail.com';                 // SMTP username
            $mail->Password = '*%Zkmq6K2Q';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->CharSet = 'UTF-8';
            $mail->setFrom('gpca.recovery@gmail.com', 'PET - Grupo de Pesquisa em Computação Aplicada');
            $mail->addAddress($email, $nome);
            $mail->addEmbeddedImage('../assets/media/logo-gpca.png', 'logo');

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Redefinir Senha';
            $mail->Body = '<div style="margin: 30px;">
                            <div class="text-center">
                                <font size=5> Olá ' . $nome . ', </font>
                            </div>
                            <div style="margin-top: 30px;">
                                <font size=3> 
                                    Use o código a seguir para redefinir sua senha de acesso ao sistema: <b> ' . $codigo . ' </b> 
                                </font>
                            </div>
                        </div>
                        <div style="margin-left: 300px;"> 
                            <img style="width:100px; height:90px;" src="cid:logo">
                        </div>';

            //echo $mail->send();
            if ($mail->send() == 1) {
                echo $id;
            } else {
                echo 1;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function validaCod(ModelLogin $login)
    {
        try {
            session_start();
            $codigo = $login->getCodigo();

            if ($codigo == $_SESSION['cod_redefinir_senha']) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function redefinirSenha(ModelLogin $login)
    {
        try {

            session_start();
            $id = $_SESSION['id_redefinir_senha'];
            $senha = md5($login->getSenha());

            $stmt = $this->conn->prepare("UPDATE integrantes SET senhaIntegrante = ? WHERE codIntegrante = ? ");

            $stmt->bindparam(1, $senha);
            $stmt->bindparam(2, $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                session_destroy();
                unset($_SESSION['id_redefinir_senha']);
                unset($_SESSION['cod_redefinir_senha']);
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function adicionarLogin(ModelLogin $login)
    {
        try {

            $nome = $login->getNome();
            $email = $login->getEmail();
            $cpf = $login->getCpf();
            $tipo = $login->getTipo();
            $senha = md5($login->getSenha());

            $stmt2 = $this->conn->prepare("SELECT * FROM integrantes WHERE cpfIntegrante = :cpf AND situacaoIntegrante LIKE 'Administrador'");
            $stmt2->execute(array(':cpf' => $cpf));

            if ($stmt2->rowCount() > 0) {
                echo 3;
            } else {

                $stmt = $this->conn->prepare("INSERT INTO integrantes(nomeIntegrante, emailIntegrante, cpfIntegrante, situacaoIntegrante, senhaIntegrante)
                VALUES (:nome, :email, :cpf, :situacao, :senha)");

                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":cpf", $cpf);
                $stmt->bindparam(":situacao", $tipo);
                $stmt->bindparam(":senha", $senha);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 2;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*public function is_loggedin() {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirecionar($url) {
        header("Location: $url");
    }*/
}
