<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json ; charset=utf-8');
  header('Acces-Control-Allow-Methods: GET');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

  if($_SERVER['REQUEST_METHOD'] == 'GET'){

    require  '../services/Bdd.php';
    require  '../models/Tarifs.php';
    require  '../services/Tarifs.php';


    if(isset($_GET['top']) && !empty($_GET['top'])){
      $id = htmlspecialchars($_GET['top']);
    }else if(isset($_GET['bottom']) && !empty($_GET['bottom'])){
      $id = htmlspecialchars($_GET['bottom']);
    }

    if($id == 1 || $id == 2){

        $objet = new ServiceTarifs();
        $data = $objet->getOffer($id);
  
        class Offer{
          public $id;
          public $idFormule;
          public $title;
          public $subTitle;
          public $description;
          public $price;
  
          public function __construct($id,$idFormule,$title,$subTitle,$description,$price){
            $this->id = $id;
            $this->idFormule = $idFormule;
            $this->title = $title;
            $this->subTitle = $subTitle;
            $this->description = $description;
            $this->price = $price;
          }
        }
  
        for ($i=0; $i < count($data); $i++) { 
          $objet = new Offer(
            $data[$i]->getID(),
            $data[$i]->getIdFormule(),
            $data[$i]->getTitle(),
            $data[$i]->getSubTitle(),
            $data[$i]->getDescription(),
            $data[$i]->getPrice()
          );
          $result[] = $objet;
        }
  
        echo json_encode($result);
    }
  }
?>