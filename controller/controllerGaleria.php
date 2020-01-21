<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarFoto();
        break;
    case 'editar':
        atualizarFoto();
        break;
    case 'excluir':
        excluirFoto();
        break;
}

function adicionarFoto() {
    require_once ('../model/ModelGaleria.php');
    require_once ('../dao/daoGaleria.php');

    $dao = new DaoGaleria();
    $Galeria = new ModelGaleria();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);

    $fileName=$_FILES['arquivo']['name'];
    
	//Faz a verificação da extensao do arquivo
    $extension= explode('.', $fileName);
    $fileExtension= end( $extension );
    
    $extensionsOK['extensoes'] = array('png', 'jpg', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG');

	//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
    $newFileName= 'imagem_' . time() . '.' . $fileExtension;

	//Pasta onde o arquivo vai ser salvo
    $local='../assets/media/galeria/';
    
    $destino= $local . $newFileName;
   
    if(array_search($fileExtension, $extensionsOK['extensoes'])=== false){		
        
    }
    else{ 
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $local. $newFileName)){
            
            $Galeria->setFoto($newFileName);
            $Galeria->setTitulo($titulo);
        
        }
    }
    $dao->adicionarFoto($Galeria);
} 

function atualizarFoto() {
    require_once ('../model/ModelGaleria.php');
    require_once ('../dao/daoGaleria.php');
    $dao = new DaoGaleria();
    $Galeria = new ModelGaleria();
   

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);


    $fileName=$_FILES['arquivo']['name'];
    
    //Faz a verificação da extensao do arquivo
    $extension= explode('.', $fileName);
    $fileExtension= end( $extension );
    
    $extensionsOK['extensoes'] = array('png', 'jpg', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG');

	//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
    $newFileName= 'imagem_' . time() . '.' . $fileExtension;

	//Pasta onde o arquivo vai ser salvo
    $local='../assets/media/galeria/';
    
    $destino= $local . $newFileName;
   
    if(array_search($fileExtension, $extensionsOK['extensoes'])=== false){		
        
    }
    else{ 
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $local. $newFileName)){
            
            $Galeria->setFoto($newFileName);
            $Galeria->setTitulo($titulo);
            $Galeria->setId($id);
        
        }
    }
    $dao->atualizarFoto($Galeria);
}



function excluirFoto() {
    require_once ('../model/ModelGaleria.php');
    require_once ('../dao/daoGaleria.php');

    $dao = new DaoGaleria();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Galeria = new ModelGaleria();
    $Galeria->setId($id);


    $dao->excluirFoto($Galeria);
}





?>