<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarInformacoes();
        break;
    case 'editar':
        atualizarInformacoes();
        break;
    case 'excluir':
        //excluirFoto();
        break;
}

function adicionarInformacoes() {
    require_once ('../model/ModelIntegrantes.php');
    require_once ('../dao/daoIntegrantes.php');

    $dao = new DaoIntegrantes();
    $Integrante = new ModelIntegrantes();
   
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $social = filter_var($_POST["social"], FILTER_SANITIZE_STRING);
    $dataInicio = filter_var($_POST["dataInicio"], FILTER_SANITIZE_STRING);
    $dataFim = filter_var($_POST["dataFim"], FILTER_SANITIZE_STRING);
    $situacao = filter_var($_POST["situacao"], FILTER_SANITIZE_STRING);
    $tipo = filter_var($_POST["tipo"], FILTER_SANITIZE_STRING);

    if($dataFim == ''){
        $dataFim = null;
    }
    
    if($_FILES['arquivo']['name'] != ''){ 

        $fileName=$_FILES['arquivo']['name'];
    
        //Faz a verificação da extensao do arquivo
        $extension= explode('.', $fileName);
        $fileExtension= end( $extension );
    

	    //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName= 'foto_' . time() . '.' . $fileExtension;

	    //Pasta onde o arquivo vai ser salvo
        $local='../assets/media/integrantes/';
   
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $local. $newFileName);
    }

    else{ 
        $newFileName = '';
    }

        $Integrante->setNome($nome);
        $Integrante->setEmail($email);
        $Integrante->setSocial($social);
        $Integrante->setDataInicio($dataInicio);
        $Integrante->setDataFIm($dataFim);
        $Integrante->setSituacao($situacao);
        $Integrante->setCpf($cpf);
        $Integrante->setTipo($tipo);
        $Integrante->setFoto($newFileName);
        $dao->adicionarInformacoes($Integrante);
} 

function atualizarInformacoes() {
    require_once ('../model/ModelIntegrantes.php');
    require_once ('../dao/daoIntegrantes.php');

    $dao = new DaoIntegrantes();
    $Integrante = new ModelIntegrantes();
   

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $social = filter_var($_POST["social"], FILTER_SANITIZE_STRING);
    $dataInicio = filter_var($_POST["dataInicio"], FILTER_SANITIZE_STRING);
    $dataFim = filter_var($_POST["dataFim"], FILTER_SANITIZE_STRING);
    $situacao = filter_var($_POST["situacao"], FILTER_SANITIZE_STRING);

    if($dataFim == ''){
        $dataFim = null;
    }
    
    if($_FILES['arquivo']['name'] != ''){ 

        $fileName=$_FILES['arquivo']['name'];
    
        //Faz a verificação da extensao do arquivo
        $extension= explode('.', $fileName);
        $fileExtension= end( $extension );
    

	    //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName= 'foto_' . time() . '.' . $fileExtension;

	    //Pasta onde o arquivo vai ser salvo
        $local='../assets/media/integrantes/';
   
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $local. $newFileName);
    }

    else{ 
        $newFileName = '';
    }

        $Integrante->setId($id);
        $Integrante->setNome($nome);
        $Integrante->setEmail($email);
        $Integrante->setSocial($social);
        $Integrante->setDataInicio($dataInicio);
        $Integrante->setDataFIm($dataFim);
        $Integrante->setSituacao($situacao);
        $Integrante->setCpf($cpf);
        $Integrante->setFoto($newFileName);
        $dao->atualizarInformacoes($Integrante);
}


/*
function excluirFoto() {
    require_once ('../model/ModelGaleria.php');
    require_once ('../dao/daoGaleria.php');

    $dao = new DaoGaleria();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Galeria = new ModelGaleria();
    $Galeria->setId($id);


    $dao->excluirFoto($Galeria);
}

*/



?>