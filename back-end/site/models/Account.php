<?php

  class Account{
    // Account
    private $id;
    private $level;
    private $mail;
    private $pass;
    private $name;
    private $surname;
    private $tel;
    
    // Client...



    // Account
    function setID($ID){
      $this->id = $ID;
    }
    function getID(){
      return $this->id;
    }

    function setLevel($Level){
      $this->level = $Level;
    }
    function getLevel(){
      return $this->level;
    }

    function setMail($Mail){
      $this->mail = $Mail;
    }
    function getMail(){
      return $this->mail;
    }

    function setPass($Pass){
      $this->pass = $Pass;
    }
    function getPass(){
      return $this->pass;
    }

    function setName($Name){
      $this->name = $Name;
    }
    function getName(){
      return $this->name;
    }

    function setSurname($Surname){
      $this->surname = $Surname;
    }
    function getSurname(){
      return $this->surname;
    }

    function setTel($Tel){
      $this->tel = $Tel;
    }
    function getTel(){
      return $this->tel;
    }

    // Client ...
  }

?>