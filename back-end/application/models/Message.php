<?php

class ModelMessages {
  // session
  private $id;
  private $name;
  private $surname;
  // recovery
  private $idReco;
  private $nameReco;
  private $surnameReco;
  // message
  private $message;
  // message global 
  private $global;
  private $date_create;
  
  // SESSION
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

  // recovery
  function setIDReco($idReco){
    $this->idReco = $idReco;
  }
  function getIDReco(){
    return $this->idReco;
  }
  function setNameReco($nameReco){
    $this->nameReco = $nameReco;
  }
  function getNameReco(){
    return $this->nameReco;
  }
  function setSurnameReco($surnameReco){
    $this->surnameReco = $surnameReco;
  }
  function getSurnameReco(){
    return $this->surnameReco;
  }

  // message
  function setMessage($message){
    $this->message = $message;
  }
  function getMessage(){
    return $this->message;
  }

  // message global
  function setGlobal($global){
    $this->global = $global;
  }
  function getGlobal(){
    return $this->global;
  }

  function setDateCreate($date_create){
    $this->date_create = $date_create;
  }
  function getDateCreate(){
    return $this->date_create;
  }
}


?>