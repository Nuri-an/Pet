<?php

class ModelProjetos{
    private $id;
    private $titulo;
    private $descricao;
    private $data;
    private $midia;
    private $publicacao;
    private $parceria;



    public function getId() {
        return $this->id;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getDescricao() {
        return $this->descricao;
    }
    public function getMidia() {
        return $this->midia;
    }
    public function getData() {
        return $this->data;
    }
    public function getPublicacao() {
        return $this->publicacao;
    }
    public function getParceria() {
        return $this->parceria;
    }


    public function setId($id) {
        $this->id = $id;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function setMidia($midia) {
        $this->midia = $midia;
    }
    public function setData($data) {
        $this->data = $data;
    }
    public function setPublicacao($publicacao) {
        $this->publicacao = $publicacao;
    }
    public function setParceria($parceria) {
        $this->parceria = $parceria;
    }
}
?>