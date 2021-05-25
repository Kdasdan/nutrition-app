<?php
  // require 'Bdd.php';
  // require '../models/Account.php';
  class ServiceForget extends Bdd {
    function forget($objet){

      $bdd = (new Bdd())->connexion();

      $req = $bdd->prepare('SELECT id FROM account WHERE email = :mail AND is_del != 1');
      $req->execute(array(
        'mail' => $objet->getMail()
      ));

      $result = $req->fetch();

      if(!empty($result)){
        $objet->setID($result['id']);
        return $objet;
      }

    }
  }

  // $test = new Account();
  // $test->setMail('a.iffli@outlook.fr');

  // $envoie = new ServiceForget();
  // var_dump($envoie->forget($test));

?>