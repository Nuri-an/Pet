<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarNoticia();
        break;
    case 'editar':
        atualizarNoticia();
        break;
    case 'excluir':
        excluirNoticia();
        break;
}

function adicionarNoticia()
{
    require_once('../model/ModelNoticias.php');
    require_once('../dao/daoNoticias.php');

    $dao = new DaoNoticias();
    $Noticia = new ModelNoticias();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $resumo = filter_var($_POST["resumoNoticia"], FILTER_SANITIZE_STRING);

    if (isset($_FILES['arquivo']['name']) && ($_FILES['arquivo']['name'] != '')) {

        $fileName = $_FILES['arquivo']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'midia_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/noticias/';

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $local . $newFileName);
    } else {
        $newFileName = '';
    }
    $Noticia->setMidia($newFileName);
    $Noticia->setTitulo($titulo);
    $Noticia->setDescricao($descricao);
    $Noticia->setData($data);
    $Noticia->setResumo($resumo);


    $dao->adicionarNoticia($Noticia);
}

function atualizarNoticia()
{
    require_once('../model/ModelNoticias.php');
    require_once('../dao/daoNoticias.php');

    $dao = new DaoNoticias();
    $Noticia = new ModelNoticias();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $resumo = filter_var($_POST["resumo"], FILTER_SANITIZE_STRING);

    if (isset($_FILES['arquivo']['name']) && ($_FILES['arquivo']['name'] != '')) {

        $fileName = $_FILES['arquivo']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'midia_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/noticias/';

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $local . $newFileName);
    } else {
        $newFileName = '';
    }

    $Noticia->setMidia($newFileName);
    $Noticia->setTitulo($titulo);
    $Noticia->setDescricao($descricao);
    $Noticia->setData($data);
    $Noticia->setResumo($resumo);
    $Noticia->setId($id);

    $dao->atualizarNoticia($Noticia);
}



function excluirNoticia()
{
    require_once('../model/ModelNoticias.php');
    require_once('../dao/daoNoticias.php');

    $dao = new DaoNoticias();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Noticia = new ModelNoticias();
    $Noticia->setId($id);


    $dao->excluirNoticia($Noticia);
}
