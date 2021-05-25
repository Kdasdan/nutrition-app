<?php
// require  'Bdd.php';
// require  '../models/Reinit.php';
  class ServiceRecovery extends Bdd {
    function getRecovery($objet){

      $bdd = (new Bdd())->connexion();
    
      $req = $bdd->query('SELECT id FROM account');
      $result = $req->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i < count($result) ; $i++) { 
        if (password_verify($result[$i]['id'], $objet->getHash())){
          $objet->setID($result[$i]['id']);
        }
      }  
      if($objet->getID()){
        return $objet;
      }
      
    }

    function setRecovery($objet){
      $bdd = (new Bdd())->connexion();


      // Recup data account
      $req = $bdd->prepare("SELECT * FROM account WHERE id = :id");
      $req->execute(array(
        'id' => $objet->getID()
      ));
      $donnees = $req->fetch(PDO::FETCH_ASSOC);

      // Delete account
      $req = $bdd->prepare(
        "UPDATE 
          account 
        SET 
          date_update = :date,
          is_del = 1
        WHERE 
          id = :id
        "
      );
      $req->execute(array(
        'date' => date( 'Y-m-d H:i:s' ),
        'id' => $objet->getID()
      ));


      // Create account new pass
      $req = $bdd->prepare('INSERT INTO account(id_level,email,account.password,account.name,surname,tel,date_create) VALUES(:id,:mail,:pass,:username,:surname,:tel,:date_create)');
      $req->execute(array(
        'id' => $donnees['id_level'],
        'mail' => $donnees['email'],
        'pass' => $objet->getPass(),
        'username' => $donnees['name'],
        'surname' => $donnees['surname'],
        'tel' => $donnees['tel'],
        'date_create' => date( 'Y-m-d H:i:s' )
      ));  

    }
  }

  // $serviceReinit = new ServiceReinit();
  // $test = new ModelReinit();
  // $test->setID(2);
  // $test->setPass('HATAIL');

  // $serviceReinit->setReinit($test);

?>