<?php

class ModelAdministradores{
    private $id;
    private $emailFrom;
    private $senhaFrom;
    private $nameFrom;
    private $msg;

    public function getId() {
        return $this->id;
    }
    public function getEmailFrom() {
        return $this->emailFrom;
    }
    public function getNameFrom() {
        return $this->nameFrom;
    }
    public function getMsg() {
        return $this->msg;
    }
    public function getSenhaFrom() {
        return $this->senhaFrom;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setEmailFrom($emailFrom) {
        $this->emailFrom = $emailFrom;
    }
    public function setNameFrom($nameFrom) {
        $this->nameFrom = $nameFrom;
    }
    public function setMsg($msg) {
        $this->msg = $msg;
    }
    public function setSenhaFrom($senhaFrom) {
        $this->senhaFrom = $senhaFrom;
    }
}
?>