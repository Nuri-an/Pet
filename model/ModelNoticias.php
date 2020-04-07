<?php

class ModelGaleria{
    private $id;
    private $titulo;
    private $descricao;
    private $midia;
    private $local;



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
    public function getLocal() {
        return $this->local;
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
    public function setLocal($local) {
        $this->local = $local;
    }
}
?>