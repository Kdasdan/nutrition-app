<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: GET');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
  require '../services/Bdd.php';
  require '../models/Message.php';
  require '../services/Message.php';

  if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['id']) && !empty($_GET['id'])){
      $id = (int)$_GET['id'];
      
      $objet = new ModelMessages();
      $objet->setID($id);

      $result = (new ServiceMessages())->getMessage($objet);

      if($result){

        class Message {
          public $id;
          public $name;
          public $surname;
          public $idReco;
          public $nameReco;
          public $surnameReco;
          public $message;
          public $date_create;
          public $global;
      
          function __construct($id, $name, $surname, $idReco = null, $nameReco = null, $surnameReco = null, $message, $date_create, $global = null) { 
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->idReco = $idReco;
            $this->nameReco = $nameReco;
            $this->surnameReco = $surnameReco;
            $this->message = $message;
            $this->date_create = $date_create;
            $this->global = $global;
          }
        }

        for ($i=0; $i < count($result); $i++) {
          if($result[$i]->getGlobal() == null){
            $objet = new Message($result[$i]->getID(), $result[$i]->getName(),$result[$i]->getSurname(), $result[$i]->getIDReco(), $result[$i]->getNameReco(), $result[$i]->getSurnameReco(), $result[$i]->getMessage(),$result[$i]->getDateCreate());
            $data[] = $objet;
          }else {
            $objet = new Message($result[$i]->getID(), $result[$i]->getName(),$result[$i]->getSurname(), null, null, null, $result[$i]->getMessage(),$result[$i]->getDateCreate(), $result[$i]->getGlobal());
            $data[] = $objet;
          } 
        }
        
        echo json_encode($data);
      }
    }
  }else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $donnees = json_decode(file_get_contents("php://input"));
        
    if(!empty($donnees->id_global) && !empty($donnees->message_global)){
      
      $id = $donnees->id_global;
      $message = htmlspecialchars($donnees->message_global);

      $objet = new ModelMessages();
      $objet->setID($id);
      $objet->setMessage($message);

      $result = (new ServiceMessages())->setMessageGlobal($objet);
    }else if (!empty($donnees->id_send) && !empty($donnees->id_recovery) && !empty($donnees->messageClick)){
      $idSend = $donnees->id_send;
      $idReco = $donnees->id_recovery;
      $message = htmlspecialchars($donnees->messageClick);

      $objet = new ModelMessages();
      $objet->setID($idSend);
      $objet->setIDReco($idReco);
      $objet->setMessage($message);

      $result = (new ServiceMessages())->setMessage($objet);
    }
  }

?>