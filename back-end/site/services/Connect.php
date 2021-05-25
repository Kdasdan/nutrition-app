<?php
  class ServiceConnect extends Bdd {
    function connect($objet){

      $bdd = (new Bdd())->connexion();

      $req = $bdd->prepare('SELECT * FROM account WHERE email = :mail AND is_del != 1');
      $req->execute(array(
        'mail' => $objet->getMail(),
      ));

      $result = $req->fetch();

      if(!empty($result)){
        if(password_verify($objet->getPass(), $result['password'])){
          $objet->setID($result['id']);
          $objet->setLevel($result['id_level']);
          $objet->setName($result['name']);
          $objet->setSurname($result['surname']);
          $objet->setTel($result['tel']);
          return $objet;
        }
      }

    }
  }

?>