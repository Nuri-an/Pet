<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionar();
        break;
    case 'editar':
        atualizar();
        break;
    case 'excluir':
        excluir();
        break;
}

function adicionar()
{
    require_once('../model/ModelDownloads.php');
    require_once('../dao/daoDownloads.php');

    $dao = new DaoDownloads();
    $Download = new ModelDownloads();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $referencia = filter_var($_POST["referencia"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["link"], FILTER_SANITIZE_STRING);

    if ((isset($_FILES['slides']['name'])) && ($_FILES['slides']['name'] != '')) {

        $fileName = $_FILES['slides']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileNameSlides = 'slides_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/downloads/';

        if(move_uploaded_file($_FILES['slides']['tmp_name'], $local . $newFileNameSlides)){
            $slides = $newFileNameSlides;
        }else{
            $slides = '';
        }
    } else {
        $slides = '';
    }
    
    if ((isset($_FILES['algoritmo']['name'])) && ($_FILES['algoritmo']['name'] != '')) {

        $fileName = $_FILES['algoritmo']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileNameAlgoritmo = 'algoritmo_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/downloads/';

        if(move_uploaded_file($_FILES['algoritmo']['tmp_name'], $local . $newFileNameAlgoritmo)){
            $algoritmo = $newFileNameAlgoritmo;
        }else{
            $algoritmo = '';
        }
    } else {
        $algoritmo = '';
    }

    $Download->setTitulo($titulo);
    $Download->setReferencia($referencia);
    $Download->setSlides($slides);
    $Download->setAlgoritmo($algoritmo);
    $Download->setLink($link);
    $dao->adicionar($Download);
}

function atualizar()
{
    require_once('../model/ModelDownloads.php');
    require_once('../dao/daoDownloads.php');

    $dao = new DaoDownloads();
    $Download = new ModelDownloads();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $referencia = filter_var($_POST["referencia"], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST["link"], FILTER_SANITIZE_STRING);
    $slidesValue = filter_var($_POST["idSlides"], FILTER_SANITIZE_STRING);
    $algoritmoValue = filter_var($_POST["idAlgoritmo"], FILTER_SANITIZE_STRING);

    if ((isset($_FILES['slides']['name'])) && ($slidesValue != 'ante') && ($slidesValue != 'vazio')) {

        $fileName = $_FILES['slides']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileNameSlides = 'slides_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/downloads/';

        if(move_uploaded_file($_FILES['slides']['tmp_name'], $local . $newFileNameSlides)){
            $slides = $newFileNameSlides;
        }else{
            $slides = '';
        }
    } else if($slidesValue == 'ante'){
        $slides = 'ante';
    } else{
        $slides = 'vazio';
    }
    
    if ((isset($_FILES['algoritmo']['name'])) && ($algoritmoValue != 'ante') && ($algoritmoValue != 'vazio')) {

        $fileName = $_FILES['algoritmo']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);
 

        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileNameAlgoritmo = 'algoritmo_' . time() . '.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/downloads/';

        if(move_uploaded_file($_FILES['algoritmo']['tmp_name'], $local . $newFileNameAlgoritmo)){
            $algoritmo = $newFileNameAlgoritmo;
        }else{
            $algoritmo = '';
        }
    } else if($algoritmoValue == 'ante'){
        $algoritmo = 'ante';
    } else{
        $algoritmo = 'vazio';
    }

    $Download->setId($id);
    $Download->setTitulo($titulo);
    $Download->setReferencia($referencia);
    $Download->setSlides($slides);
    $Download->setAlgoritmo($algoritmo);
    $Download->setLink($link);
    $dao->atualizar($Download);
}


function excluir() {
    require_once('../model/ModelDownloads.php');
    require_once('../dao/daoDownloads.php');

    $dao = new DaoDownloads();
    $Download = new ModelDownloads();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Download->setId($id);


    $dao->excluir($Download);
}