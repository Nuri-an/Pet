<?php

class ModelLogin{
    private $id;
    private $cpf;
    private $senha;



    public function getId() {
        return $this->id;
    }
    public function getCpf() {
        return $this->cpf;
    }
    public function getSenha() {
        return $this->senha;
    }
    

    public function setId($id) {
        $this->id = $id;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }
}
?>