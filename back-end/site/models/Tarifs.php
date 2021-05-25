<?php 

  class ModelTarifs{
    private $id;
    private $idFormule;
    private $title;
    private $subTitle;
    private $description;
    private $price;
    
    public function setID($id) {
      $this->id = $id;
    }
    public function getID(){
      return $this->id;
    }

    public function setIdFormule($idFormule) {
      $this->idFormule = $idFormule;
    }
    public function getIdFormule(){
      return $this->idFormule;
    }
    
    public function setTitle($title) {
      $this->title = $title;
    }
    public function getTitle() {
      return $this->title;
    }

    public function setSubTitle($subTitle) {
      $this->subTitle = $subTitle;
    }
    public function getSubTitle(){
      return $this->subTitle;
    }


    public function setDescription($description) {
      $this->description = $description;
    }
    
    public function getDescription(){
      return $this->description;
    }


    public function setPrice($price) {
      $this->price = $price;
    }
    public function getPrice() {
      return $this->price;
    }

  }

?>