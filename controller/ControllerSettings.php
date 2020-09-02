<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'editar':
        editarSettings();
        break;
}

function editarSettings()
{
    require_once('../model/ModelSettings.php');
    require_once('../dao/daoSettings.php');

    $dao = new DaoSettings();
    $Settings = new ModelSettings();

    $facebook = filter_var($_POST["facebook-settings"], FILTER_SANITIZE_STRING);
    $instagram = filter_var($_POST["instagram-settings"], FILTER_SANITIZE_STRING);
    $rodape = nl2br($_POST["rodape-settings"]);
    
    if (isset($_FILES['capa-settings']['name']) && ($_FILES['capa-settings']['name'] != '')) {

        $fileName = $_FILES['capa-settings']['name'];

        //Faz a verificação da extensao do arquivo
        $extension = explode('.', $fileName);
        $fileExtension = end($extension);


        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão
        $newFileName = 'capa.' . $fileExtension;

        //Pasta onde o arquivo vai ser salvo
        $local = '../assets/media/';

        move_uploaded_file($_FILES['capa-settings']['tmp_name'], $local . $newFileName);
    } else {
        $newFileName = '';
    }
    
    $Settings->setCapa($newFileName);
    $Settings->setFacebook($facebook);
    $Settings->setInstagram($instagram);
    $Settings->setRodape($rodape);


    $dao->editarSettings($Settings);
}