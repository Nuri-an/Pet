<?php

class ModelInformacoes{
    private $id;
    private $tituloP;
    private $infoP;
    private $tituloS;
    private $extra;



    public function getId() {
        return $this->id;
    }
    public function getTituloP() {
        return $this->tituloP;
    }
    public function getInfoP() {
        return $this->infoP;
    }
    public function getTituloS() {
        return $this->tituloS;
    }
    public function getInfoS() {
        return $this->infoS;
    }
    public function getExtra() {
        return $this->extra;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setTituloP($tituloP) {
        $this->tituloP = $tituloP;
    }
    public function setInfoP($infoP) {
        $this->infoP = $infoP;
    }
    public function setTituloS($tituloS) {
        $this->tituloS = $tituloS;
    }
    public function setInfoS($infoS) {
        $this->infoS = $infoS;
    }
    public function setExtra($extra) {
        $this->extra = $extra;
    }
}
?>