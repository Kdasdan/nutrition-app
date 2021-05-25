<?php
  class ServiceMembres extends Bdd{
    function getMembre($objet){
      $bdd = (new Bdd())->connexion();

      $req = $bdd->prepare(
        'SELECT 
          id,
          name,
          surname
        FROM 
          account
        WHERE 
          id != :id'
      );
      $req->execute(array(
        'id' => $objet->getID()
      ));

      $result = $req->fetchAll(PDO::FETCH_ASSOC);

      if($result){
        for ($i=0; $i < count($result); $i++) { 
          $objet = new ModelMembre();
          $objet->setID($result[$i]['id']);
          $objet->setName($result[$i]['name']);
          $objet->setSurname($result[$i]['surname']);
          $data[] = $objet;
        }
        return $data;
      }
    }
  }