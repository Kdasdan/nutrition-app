<?php

  class ModelRecovery{
    private $id;
    private $pass;
    private $hash;

    function setID($id){
      $this->id = $id;
    }
    function getID(){
      return $this->id;
    }

    function setPass($pass){
      $this->pass = $pass;
    }
    function getPass(){
      return $this->pass;
    }

    function setHash($hash){
      $this->hash = $hash;
    }
    function getHash(){
      return $this->hash;
    }

  }

?>