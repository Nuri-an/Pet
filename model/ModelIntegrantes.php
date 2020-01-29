<?php

class ModelIntegrantes{
    private $id;
    private $foto;
    private $nome;
    private $email;
    private $cpf;
    private $social;
    private $dataInicio;
    private $dataFim;
    private $situacao;
    private $tipo;



    public function getId() {
        return $this->id;
    }
    public function getFoto() {
        return $this->foto;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getCpf() {
        return $this->cpf;
    }
    public function getSocial() {
        return $this->social;
    }
    public function getDataInicio() {
        return $this->dataInicio;
    }
    public function getDataFim() {
        return $this->dataFim;
    }
    public function getSituacao() {
        return $this->situacao;
    }
    public function getTipo() {
        return $this->tipo;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setFoto($foto) {
        $this->foto = $foto;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    public function setSocial($social) {
        $this->social = $social;
    }
    public function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }
    public function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }
    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}
?>