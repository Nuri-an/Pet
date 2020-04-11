<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarPublicacao();
        break;
    case 'editar':
        atualizarPublicacao();
        break;
    case 'excluir':
        excluirPublicacao();
        break;
}

function adicionarPublicacao()
{
    require_once('../model/ModelPublicacoes.php');
    require_once('../dao/daoPublicacoes.php');

    $dao = new DaoPublicacoes();
    $Publicacao = new ModelPublicacoes();

    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["link"], FILTER_SANITIZE_STRING);

    
    $Publicacao->setDescricao($descricao);
    $Publicacao->setData($data);
    $Publicacao->setLink($link);


    $dao->adicionarPublicacao($Publicacao);
}

function atualizarPublicacao()
{
    require_once('../model/ModelPublicacoes.php');
    require_once('../dao/daoPublicacoes.php');

    $dao = new DaoPublicacoes();
    $Publicacao = new ModelPublicacoes();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["link"], FILTER_SANITIZE_STRING);


    $Publicacao->setDescricao($descricao);
    $Publicacao->setData($data);
    $Publicacao->setLink($link);
    $Publicacao->setId($id);

    $dao->atualizarPublicacao($Publicacao);
}



function excluirPublicacao()
{
    require_once('../model/ModelPublicacoes.php');
    require_once('../dao/daoPublicacoes.php');

    $dao = new DaoPublicacoes();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Publicacao = new ModelPublicacoes();
    $Publicacao->setId($id);


    $dao->excluirPublicacao($Publicacao);
}
