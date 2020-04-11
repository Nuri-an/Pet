<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarProjeto();
        break;
    case 'editar':
        atualizarProjeto();
        break;
    case 'excluir':
        excluirProjeto();
        break;
}

function adicionarProjeto()
{
    require_once('../model/ModelProjetos.php');
    require_once('../dao/daoProjetos.php');

    $dao = new DaoProjetos();
    $projeto = new ModelProjetos();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $publicacao = filter_var($_POST["publicacao"], FILTER_SANITIZE_STRING);
    $parceria = filter_var($_POST["parceria"], FILTER_SANITIZE_STRING);

    if ($_FILES['arquivo']['name'] != '') {

        $fileName = $_FILES['arquivo']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'midia_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/projetos/';

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $local . $newFileName);
    } else {
        $newFileName = '';
    }
    $projeto->setMidia($newFileName);
    $projeto->setTitulo($titulo);
    $projeto->setDescricao($descricao);
    $projeto->setData($data);
    $projeto->setPublicacao($publicacao);
    $projeto->setParceria($parceria);


    $dao->adicionarProjeto($projeto);
}

function atualizarProjeto()
{
    require_once('../model/ModelProjetos.php');
    require_once('../dao/daoProjetos.php');

    $dao = new DaoProjetos();
    $projeto = new ModelProjetos();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $publicacao = filter_var($_POST["publicacao"], FILTER_SANITIZE_STRING);
    $parceria = filter_var($_POST["parceria"], FILTER_SANITIZE_STRING);

    if ($_FILES['arquivo']['name'] != '') {

        $fileName = $_FILES['arquivo']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'midia_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/Projetos/';

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $local . $newFileName);
    } else {
        $newFileName = '';
    }

    $projeto->setMidia($newFileName);
    $projeto->setTitulo($titulo);
    $projeto->setDescricao($descricao);
    $projeto->setData($data);
    $projeto->setPublicacao($publicacao);
    $projeto->setParceria($parceria);
    $projeto->setId($id);

    $dao->atualizarProjeto($projeto);
}



function excluirProjeto()
{
    require_once('../model/ModelProjetos.php');
    require_once('../dao/daoProjetos.php');

    $dao = new DaoProjetos();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $projeto = new ModelProjetos();
    $projeto->setId($id);


    $dao->excluirProjeto($projeto);
}
