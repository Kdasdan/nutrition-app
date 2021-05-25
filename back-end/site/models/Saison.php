<?php 

  class ModelSaison{
    private $idSaison;
    private $saison;

    function setIdSaison($idSaison){
      $this->idSaison = $idSaison;
    }
    function getIdSaison(){
      return $this->idSaison;
    }

    function setSaison($saison){
      $this->saison = $saison;
    }
    function getSaison(){
      return $this->saison;
    }

  }

?>