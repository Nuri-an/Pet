<?php

class ModelSettings{
    private $id;
    private $capa;
    private $facebook;
    private $instagram;
    private $rodape;



    public function getId() {
        return $this->id;
    }
    public function getCapa() {
        return $this->capa;
    }
    public function getFacebook() {
        return $this->facebook;
    }
    public function getInstagram() {
        return $this->instagram;
    }
    public function getRodape() {
        return $this->rodape;
    }


    public function setId($id) {
        $this->id = $id;
    }
    public function setCapa($capa) {
        $this->capa = $capa;
    }
    public function setFacebook($facebook) {
        $this->facebook = $facebook;
    }
    public function setInstagram($instagram) {
        $this->instagram = $instagram;
    }
    public function setRodape($rodape) {
        $this->rodape = $rodape;
    }
}
?>