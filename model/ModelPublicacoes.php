<?php

class ModelPublicacoes{
    private $id;
    private $descricao;
    private $link;
    private $data;



    public function getId() {
        return $this->id;
    }
    public function getDescricao() {
        return $this->descricao;
    }
    public function getLink() {
        return $this->link;
    }
    public function getData() {
        return $this->data;
    }


    public function setId($id) {
        $this->id = $id;
    }
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function setLink($link) {
        $this->link = $link;
    }
    public function setData($data) {
        $this->data = $data;
    }
}
?>