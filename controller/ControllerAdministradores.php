<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'aceitar':
        aceitarSolicitacao();
        break;
    case 'cancelar':
        cancelarSolicitacao();
        break;
    case 'excluirPerfil':
        excluirPerfil();
        break;
}

function aceitarSolicitacao() {
    require_once ('../model/ModelAdministradores.php');
    require_once ('../dao/DaoAdministradores.php');

    $dao = new DaoAdministradores();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);

    $Administradores = new ModelAdministradores();

    $Administradores->setMsg('Sua solicitação de acesso a área administrativa do site foi analisada e <b> aceita </b> por um dos atuais administradores. A partir de agora você poderá acessa a plataforma com seu CPF e senha cadastrados.');
    $Administradores->setEmailFrom('gpca.recovery@gmail.com');
    $Administradores->setNameFrom('PET - Ciência da Computação');
    $Administradores->setSenhaFrom('*%Zkmq6K2Q');
    $Administradores->setId($id);

    $dao->aceitarSolicitacao($Administradores);
    
}

function cancelarSolicitacao() {
    require_once ('../model/ModelAdministradores.php');
    require_once ('../dao/DaoAdministradores.php');

    $dao = new DaoAdministradores();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);

    $Administradores = new ModelAdministradores();

    $Administradores->setMsg('Sua solicitação de acesso a área administrativa foi analisada e <b> recusada </b> por um dos atuais administradores. Para mais esclarecimentos entre contato com o grupo.');
    $Administradores->setEmailFrom('gpca.recovery@gmail.com');
    $Administradores->setNameFrom('PET - Ciência da Computação');
    $Administradores->setSenhaFrom('*%Zkmq6K2Q');
    $Administradores->setId($id);
    
    $dao->cancelarSolicitacao($Administradores);
}

function excluirPerfil() {
    require_once ('../model/ModelAdministradores.php');
    require_once ('../dao/DaoAdministradores.php');

    $dao = new DaoAdministradores();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Administradores = new ModelAdministradores();

    $Administradores->setId($id);
    
    $dao->excluirPerfil($Administradores);
}


?>