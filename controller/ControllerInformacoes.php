<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarAluno();
        break;
    case 'editar':
        atualizarInfo();
        break;
    case 'excluir':
        deletarAluno();
        break;
}
/*
function adicionarAluno() {
    require_once ('../model/ModelAluno.php');
    require_once ('../dao/DaoAluno.php');
    $dao = new DaoAluno();

    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
    $idc = filter_var($_POST["idC"], FILTER_SANITIZE_STRING);




    $Aluno = new ModelAluno();
    $Aluno->setNomeAluno($nome);
    $Aluno->setCpfAluno($cpf);
    $Aluno->setDataAluno($data);
    $Aluno->setEmailAluno($email);
    $Aluno->setSenhaAluno($senha);
    $Aluno->setIdCurso($idc);


    $dao->adicionarAluno($Aluno);
    
} */

function atualizarInfo() {
    require_once ('../model/ModelInformacoes.php');
    require_once ('../dao/DaoInformacoes.php');
    $dao = new DaoInformacoes();
   

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $tituloP = filter_var($_POST["tituloP"], FILTER_SANITIZE_STRING);
    $infoP = filter_var($_POST["infoP"], FILTER_SANITIZE_STRING);
    $tituloS = filter_var($_POST["tituloS"], FILTER_SANITIZE_STRING);
    $infoS = filter_var($_POST["infoS"], FILTER_SANITIZE_STRING);



    $Informacoes = new ModelInformacoes();
    $Informacoes->setId($id);
    $Informacoes->setTituloP($tituloP);
    $Informacoes->setInfoP($infoP);
    $Informacoes->setTituloS($tituloS);
    $Informacoes->setInfoS($infoS);


    $dao->atualizarInformacoes($Informacoes);
}



/*function deletarAluno() {
    require_once ('../model/ModelAluno.php');
    require_once ('../dao/DaoAluno.php');

    $dao = new DaoAluno();
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Aluno = new ModelAluno();
    $Aluno->setIdAluno($id);


    $dao->excluirAluno($Aluno);
}

*/



?>