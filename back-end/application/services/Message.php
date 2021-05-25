<?php
  // require './bdd.php';
  // require '../models/Message.php';
  class ServiceMessages extends Bdd{
    function getMessage($objets){
      $bdd = (new Bdd())->connexion();

      $req = $bdd->prepare(
        'SELECT 
          -- messages
          msg.message mm, 
          msg.id_send mis,
          msg.id_recovery mir, 
          msg.date_create mdc, 
          -- account
          acnt.id ai, 
          acnt.name an, 
          acnt.surname aun 
        FROM 
          messages msg
        INNER JOIN 
          account acnt
        ON 
          acnt.id = msg.id_send 
        WHERE 
          msg.id_send = :id 
        OR 
          msg.id_recovery = :id 
        OR 
          msg.id_recovery = 0 
        ORDER BY 
          msg.date_create
        DESC
        LIMIT 
          10' 
      );
      $req->execute(array(
        'id' => $objets->getID()
      ));

      $result = $req->fetchAll(PDO::FETCH_ASSOC);

      if($result){

        for ($i=0; $i < count($result); $i++) { 

          if($result[$i]['mir'] == 0){

            $objet = new ModelMessages();
            $objet->setID($result[$i]['ai']);
            $objet->setName($result[$i]['an']);
            $objet->setSurname($result[$i]['aun']);
            $objet->setMessage($result[$i]['mm']);
            // format date
            $date = new DateTime($result[$i]['mdc']);
            $objet->setDateCreate($date->format("d-m-Y H:i"));
            $objet->setGlobal('message global');
            $data[] = $objet;

          }else {
            $objet = new ModelMessages();
            if($result[$i]['mir'] != $objets->getID() && $result[$i]['mir'] != 0 ){
              $req = $bdd->prepare('SELECT id,name,surname FROM account WHERE id = :id');
              $req->execute(array(
                'id' => $result[$i]['mir']
              ));
              $donnees = $req->fetch(PDO::FETCH_ASSOC);
              $objet->setIDReco($donnees['id']);
              $objet->setNameReco($donnees['name']);
              $objet->setSurnameReco($donnees['surname']);
            }
            $objet->setID($result[$i]['ai']);
            $objet->setName($result[$i]['an']);
            $objet->setSurname($result[$i]['aun']);
            $objet->setMessage($result[$i]['mm']);
            // format date
            $date = new DateTime($result[$i]['mdc']);
            $objet->setDateCreate($date->format("d-m-Y H:i"));
            $data[] = $objet;
          }
          // var_dump($objet);
        }
        return $data;
      }
    }

    function setMessageGlobal($objet){
      $bdd = (new Bdd())->connexion();
      $req = $bdd->prepare(
        'INSERT INTO 
          messages(id_send, messages.message, date_create)
        VALUES
          (:id_send,:msg, :date_create)
        '
      );
      $req->execute(array(
        'id_send' => $objet->getID(),
        'msg' => $objet->getMessage(),
        'date_create' => date('Y-m-d H:i:s')
      ));
    }

    function setMessage($objet){
      $bdd = (new Bdd())->connexion();
      $req = $bdd->prepare(
        'INSERT INTO 
          messages(id_send,id_recovery, messages.message, date_create)
        VALUES
          (:id_send, :id_recovery, :msg, :date_create)
        '
      );
      $req->execute(array(
        'id_send' => $objet->getID(),
        'id_recovery' => $objet->getIDReco(),
        'msg' => $objet->getMessage(),
        'date_create' => date('Y-m-d H:i:s')
      ));
    }
  }

// (new ServiceMessages())->getMessage();