<?php

class ModelLogin{
    private $id;
    private $cpf;
    private $nome;
    private $email;
    private $tipo;
    private $senha;
    private $codigo;



    public function getId() {
        return $this->id;
    }
    public function getCpf() {
        return $this->cpf;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTipo() {
        return $this->tipo;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function getCodigo() {
        return $this->codigo;
    }
    

    public function setId($id) {
        $this->id = $id;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
}
?>