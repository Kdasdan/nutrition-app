<?php

  class ModelMembre {
    private $id;
    private $name;
    private $surname;

    function setID($id){
      $this->id = $id;
    }
    function getID(){
      return $this->id;
    }

    function setName($name){
      $this->name = $name;
    }
    function getName(){
      return $this->name;
    }

    function setSurname($surname){
      $this->surname = $surname;
    }
    function getSurname(){
      return $this->surname;
    }
  }