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

    $Administradores->setId($id);

    $dao->aceitarSolicitacao($Administradores);
    
}

function cancelarSolicitacao() {
    require_once ('../model/ModelAdministradores.php');
    require_once ('../dao/DaoAdministradores.php');

    $dao = new DaoAdministradores();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Administradores = new ModelAdministradores();

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