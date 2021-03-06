<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'editar':
        atualizarInfo();
        break;
    case 'adicionarF':
        adicionarFoto();
        break;
    case 'adicionarV':
        adicionarVideo();
        break;
    case 'editarF':
        atualizarFoto();
        break;
    case 'editarV':
        atualizarVideo();
        break;
    case 'excluir':
        excluirMidia();
        break;
}


function atualizarInfo()
{
    require_once('../model/ModelSobre.php');
    require_once('../dao/daoSobre.php');
    $dao = new DaoSobre();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $tituloP = filter_var($_POST["tituloP"], FILTER_SANITIZE_STRING);
    $infoP = filter_var($_POST["infoP"], FILTER_SANITIZE_STRING);
    $tituloS = filter_var($_POST["tituloS"], FILTER_SANITIZE_STRING);
    $infoS = filter_var($_POST["infoS"], FILTER_SANITIZE_STRING);
    $extra = nl2br($_POST["extra"]);



    $Informacoes = new ModelSobre();
    $Informacoes->setId($id);
    $Informacoes->setTituloP($tituloP);
    $Informacoes->setInfoP($infoP);
    $Informacoes->setTituloS($tituloS);
    $Informacoes->setInfoS($infoS);
    $Informacoes->setExtra($extra);


    $dao->atualizarInformacoes($Informacoes);
}


function adicionarFoto()
{
    require_once('../model/ModelSobre.php');
    require_once('../dao/daoSobre.php');

    $dao = new DaoSobre();
    $Galeria = new ModelSobre();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);

    if (isset($_FILES['foto']['name'])) {
        $fileName = $_FILES['foto']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'imagem_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/galeria/';

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $local . $newFileName)) {
        } else {
            $newFileName = '';
        }
    } else {
        $newFileName = '';
    }

    $Galeria->setMidia($newFileName);
    $Galeria->setTitulo($titulo);
    $Galeria->setLink($link);


    $dao->adicionarMidia($Galeria);
}

function adicionarVideo()
{
    require_once('../model/ModelSobre.php');
    require_once('../dao/daoSobre.php');

    $dao = new DaoSobre();
    $Galeria = new ModelSobre();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);

    if (isset($_FILES['video']['name'])) {
        $fileName = $_FILES['video']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'video_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/galeria/';

        if (move_uploaded_file($_FILES['video']['tmp_name'], $local . $newFileName)) {
        } else {
            $newFileName = '';
        }
    } else {
        $newFileName = '';
    }

    $Galeria->setMidia($newFileName);
    $Galeria->setTitulo($titulo);
    $Galeria->setLink($link);


    $dao->adicionarMidia($Galeria);
}

function atualizarFoto()
{
    require_once('../model/ModelSobre.php');
    require_once('../dao/daoSobre.php');

    $dao = new DaoSobre();
    $Galeria = new ModelSobre();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);
    $imagemValue = filter_var($_POST["idImagem"], FILTER_SANITIZE_STRING);

    if ((isset($_FILES['foto']['name'])) && ($imagemValue != 'ante')) {

        $fileName = $_FILES['foto']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'imagem_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/galeria/';

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $local . $newFileName)) {
            $imagem = $newFileName;
        } else {
            $imagem = '';
        }
    } else if ($imagemValue == 'ante') {
        $imagem = 'ante';
    }


    $Galeria->setMidia($imagem);
    $Galeria->setTitulo($titulo);
    $Galeria->setLink($link);
    $Galeria->setId($id);

    $dao->atualizarMidia($Galeria);
}

function atualizarVideo()
{
    require_once('../model/ModelSobre.php');
    require_once('../dao/daoSobre.php');

    $dao = new DaoSobre();
    $Galeria = new ModelSobre();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);
    $videoValue = filter_var($_POST["idVideo"], FILTER_SANITIZE_STRING);

    if ((isset($_FILES['video']['name'])) && ($videoValue != 'ante') && ($videoValue != 'vazio')) {
        $fileName = $_FILES['video']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'video_' . time() . '.' . $fileExtension;

        echo 'erros ' . var_dump($_FILES['video']) . ' ';

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/galeria/';

        if (move_uploaded_file($_FILES['video']['tmp_name'], $local . $newFileName)) {
            $video = $newFileName;
        } else {
            $video = '';
        }
    } else if ($videoValue == 'ante') {
        $video = 'ante';
    } else {
        $video = 'vazio';
    }

    $Galeria->setId($id);
    $Galeria->setMidia($video);
    $Galeria->setTitulo($titulo);
    $Galeria->setLink($link);


    $dao->atualizarMidia($Galeria);
}

function excluirMidia()
{
    require_once('../model/ModelSobre.php');
    require_once('../dao/daoSobre.php');

    $dao = new DaoSobre();
    $Galeria = new ModelSobre();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Galeria->setId($id);


    $dao->excluirMidia($Galeria);
}
