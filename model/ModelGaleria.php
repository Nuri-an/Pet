<?php

class ModelGaleria{
    private $id;
    private $titulo;
    private $foto;



    public function getId() {
        return $this->id;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getFoto() {
        return $this->foto;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function setFoto($foto) {
        $this->foto = $foto;
    }
}
?>