<?php

$acao = filter_input(INPUT_POST, "acao", FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'logar':
        logarAdm();
        break;
    case 'cadastrar':
        cadastrarAdm();
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
