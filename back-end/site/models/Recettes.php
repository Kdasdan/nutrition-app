<?php 

  class ModelRecettes{
    private $season;
    private $category;
    private $id;
    private $image;
    private $title;
    private $file_name;

    public function setSeason($season) {
      $this->season = $season;
    }
    public function getSeason(){
      return $this->season;
    }

    public function setCategory($category) {
      $this->category = $category;
    }
    public function getCategory(){
      return $this->category;
    }

    public function setID($id) {
      $this->id = $id;
    }
    public function getID(){
      return $this->id;
    }

    public function setImage($image) {
      $this->image = $image;
    }
    
    public function getImage(){
      return $this->image;
    }

    public function setTitle($title) {
      $this->title = $title;
    }
    public function getTitle() {
      return $this->title;
    }

    public function setFileName($file_name) {
      $this->file_name = $file_name;
    }
    public function getFileName() {
      return $this->file_name;
    }

  }

?>