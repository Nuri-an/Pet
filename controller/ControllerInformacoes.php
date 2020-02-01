<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'editar':
        atualizarInfo();
        break;
    case 'adicionar':
        adicionarFoto();
        break;
    case 'editarF':
        atualizarFoto();
        break;
    case 'excluir':
        excluirFoto();
        break;
}


function atualizarInfo()
{
    require_once('../model/ModelInformacoes.php');
    require_once('../dao/DaoInformacoes.php');
    $dao = new DaoInformacoes();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $tituloP = filter_var($_POST["tituloP"], FILTER_SANITIZE_STRING);
    $infoP = filter_var($_POST["infoP"], FILTER_SANITIZE_STRING);
    $tituloS = filter_var($_POST["tituloS"], FILTER_SANITIZE_STRING);
    $infoS = filter_var($_POST["infoS"], FILTER_SANITIZE_STRING);
    $extra = nl2br($_POST["extra"]);



    $Informacoes = new ModelInformacoes();
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
    require_once('../model/ModelInformacoes.php');
    require_once('../dao/DaoInformacoes.php');

    $dao = new DaoInformacoes();
    $Galeria = new ModelInformacoes();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);

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

    $Galeria->setFoto($newFileName);
    $Galeria->setTitulo($titulo);


    $dao->adicionarFoto($Galeria);
}


function atualizarFoto() {
    require_once('../model/ModelInformacoes.php');
    require_once('../dao/DaoInformacoes.php');

    $dao = new DaoInformacoes();
    $Galeria = new ModelInformacoes();
   

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);

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

        $Galeria->setFoto($newFileName);
        $Galeria->setTitulo($titulo);
        $Galeria->setId($id);
        $dao->atualizarFoto($Galeria);
}


function excluirFoto() {
    require_once('../model/ModelInformacoes.php');
    require_once('../dao/DaoInformacoes.php');

    $dao = new DaoInformacoes();
    $Galeria = new ModelInformacoes();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Galeria->setId($id);


    $dao->excluirFoto($Galeria);
}