<?php

$acao = filter_input(INPUT_POST, "acao", FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'logar':
        logarAdm();
        break;
    case 'cadastrar':
        cadastrarAdm();
        break;
    case 'gerarCod':
        codSenha();
        break;
    case 'validaCod':
        validaCodSenha();
        break;
    case 'redefinir':
        redefinirSenha();
        break;
}

function logarAdm()
{
    require_once('../model/ModelLogin.php');
    require_once('../dao/daoLogin.php');

    $dao = new DaoLogin();
    $Logar = new ModelLogin();

    $cpfLogar = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_EMAIL);
    $senhaLogar = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

    $Logar->setCpf($cpfLogar);
    $Logar->setSenha($senhaLogar);

    $dao->logarAdm($Logar);
}

function cadastrarAdm()
{
    require_once('../model/ModelLogin.php');
    require_once('../dao/daoLogin.php');

    $dao = new DaoLogin();
    $Login = new ModelLogin();

    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $tipo = filter_var($_POST["situacao"], FILTER_SANITIZE_STRING);
    $senha = filter_var($_POST["senhaAdm"], FILTER_SANITIZE_STRING);

    $Login->setNome($nome);
    $Login->setEmail($email);
    $Login->setCpf($cpf);
    $Login->setTipo($tipo);
    $Login->setSenha($senha);
    $dao->adicionarLogin($Login);
}

function codSenha()
{
    require_once('../model/ModelLogin.php');
    require_once('../dao/daoLogin.php');

    $dao = new DaoLogin();
    $Login = new ModelLogin();

    session_start();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);
    $codigo = rand(1000, 9999);
    $_SESSION['cod_redefinir_senha'] = $codigo;

    $Login->setMsg('Use o código a seguir para redefinir sua senha de acesso ao sistema: <b> ' . $codigo . ' </b>');
    $Login->setEmailFrom('gpca.recovery@gmail.com');
    $Login->setNameFrom('PET - Ciência da Computação');
    $Login->setSenhaFrom('*%Zkmq6K2Q');
    $Login->setId($id);
    $dao->sendMail($Login);
}

function validaCodSenha()
{
    require_once('../model/ModelLogin.php');
    require_once('../dao/daoLogin.php');

    $dao = new DaoLogin();
    $Login = new ModelLogin();

    $codigo = filter_var($_POST["codigo"], FILTER_SANITIZE_STRING);

    $Login->setCodigo($codigo);
    $dao->validaCod($Login);
}
function redefinirSenha()
{
    require_once('../model/ModelLogin.php');
    require_once('../dao/daoLogin.php');

    $dao = new DaoLogin();
    $Login = new ModelLogin();

    $senha = filter_var($_POST["newSenha"], FILTER_SANITIZE_STRING);

    $Login->setSenha($senha);
    $dao->redefinirSenha($Login);
}

if (isset($_GET['acao'])) {
    $acao2 = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);
    if ($acao2 == 'logout') {
        session_start();
        session_destroy();
        unset($_SESSION['adm_session']);
        header("Location: ../view/index.php");
    }
}
