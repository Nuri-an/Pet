<?php

class ModelNoticias{
    private $id;
    private $titulo;
    private $descricao;
    private $midia;
    private $resumo;
    private $data;



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
    public function getResumo() {
        return $this->resumo;
    }
    public function getData() {
        return $this->data;
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
    public function setResumo($resumo) {
        $this->resumo = $resumo;
    }
    public function setData($data) {
        $this->data = $data;
    }
}
?>