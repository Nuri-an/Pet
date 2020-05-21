<?php

class ModelDownloads{
    private $id;
    private $titulo;
    private $referencia;
    private $slides;
    private $algoritmo;
    private $link;



    public function getId() {
        return $this->id;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getReferencia() {
        return $this->referencia;
    }
    public function getSlides() {
        return $this->slides;
    }
    public function getAlgoritmo() {
        return $this->algoritmo;
    }
    public function getLink() {
        return $this->link;
    }


    public function setId($id) {
        $this->id = $id;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function setReferencia($referencia) {
        $this->referencia = $referencia;
    }
    public function setSlides($slides) {
        $this->slides = $slides;
    }
    public function setAlgoritmo($algoritmo) {
        $this->algoritmo = $algoritmo;
    }
    public function setLink($link) {
        $this->link = $link;
    }
}
?>