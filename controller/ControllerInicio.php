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
    require_once('../model/ModelInicio.php');
    require_once('../dao/daoInicio.php');
    $dao = new DaoInicio();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $tituloP = filter_var($_POST["tituloP"], FILTER_SANITIZE_STRING);
    $infoP = filter_var($_POST["infoP"], FILTER_SANITIZE_STRING);
    $tituloS = filter_var($_POST["tituloS"], FILTER_SANITIZE_STRING);
    $infoS = filter_var($_POST["infoS"], FILTER_SANITIZE_STRING);
    $extra = nl2br($_POST["extra"]);



    $Informacoes = new ModelInicio();
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
    require_once('../model/ModelInicio.php');
    require_once('../dao/daoInicio.php');

    $dao = new DaoInicio();
    $Galeria = new ModelInicio();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);

    if ($_FILES['arquivo']['name'] != '') {
        $fileName = $_FILES['arquivo']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'imagem_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/galeria/';

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $local . $newFileName);

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
    require_once('../model/ModelInicio.php');
    require_once('../dao/daoInicio.php');

    $dao = new DaoInicio();
    $Galeria = new ModelInicio();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);

    if (($_FILES['video']['name'] != '') && ($_FILES['video']['error'] == 0)) {
        $fileName = $_FILES['video']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'video_' . time() . '.' . $fileExtension;

        echo 'erros ' . var_dump($_FILES['video']) . ' ';
    
        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/galeria/';

        move_uploaded_file($_FILES['video']['tmp_name'], $local . $newFileName);

    } else {
        $newFileName = '';
    }
    
    $Galeria->setMidia($newFileName);
    $Galeria->setTitulo($titulo);
    $Galeria->setLink($link);


    $dao->adicionarMidia($Galeria);
}

function atualizarFoto() {
    require_once('../model/ModelInicio.php');
    require_once('../dao/daoInicio.php');

    $dao = new DaoInicio();
    $Galeria = new ModelInicio();
   

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);

    if($_FILES['arquivo']['name'] != ''){ 

        $fileName=$_FILES['arquivo']['name'];
    
        //Faz a verificação da extensao do arquivo
        $extension= explode('.', $fileName);
        $fileExtension= end( $extension );

	    //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName= 'imagem_' . time() . '.' . $fileExtension;

	    //Pasta onde o arquivo vai ser salvo
        $local='../assets/media/galeria/';
    
        $destino= $local . $newFileName;
   
         move_uploaded_file($_FILES['arquivo']['tmp_name'], $local. $newFileName);
              
    }
    else{ 
        $newFileName = '';
    }

        $Galeria->setMidia($newFileName);
        $Galeria->setTitulo($titulo);
        $Galeria->setLink($link);
        $Galeria->setId($id);

        $dao->atualizarMidia($Galeria);
}

function atualizarVideo()
{
    require_once('../model/ModelInicio.php');
    require_once('../dao/daoInicio.php');

    $dao = new DaoInicio();
    $Galeria = new ModelInicio();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["videoLink"], FILTER_SANITIZE_STRING);

    if (($_FILES['video']['name'] != '') && ($_FILES['video']['error'] == 0)) {
        $fileName = $_FILES['video']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'video_' . time() . '.' . $fileExtension;

        echo 'erros ' . var_dump($_FILES['video']) . ' ';
    
        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/galeria/';

        move_uploaded_file($_FILES['video']['tmp_name'], $local . $newFileName);

    } else {
        $newFileName = '';
    }

    $Galeria->setId($id);
    $Galeria->setMidia($newFileName);
    $Galeria->setTitulo($titulo);
    $Galeria->setLink($link);


    $dao->atualizarMidia($Galeria);
}

function excluirMidia() {
    require_once('../model/ModelInicio.php');
    require_once('../dao/daoInicio.php');

    $dao = new DaoInicio();
    $Galeria = new ModelInicio();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Galeria->setId($id);


    $dao->excluirMidia($Galeria);
}