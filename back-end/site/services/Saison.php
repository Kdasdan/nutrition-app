<?php
  class ServiceSaison extends Bdd{
    function getSaison(){
      $bdd = (new Bdd())->connexion();
      $req = $bdd->query('SELECT * FROM recipie_season');
      $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i <count($donnees) ; $i++) { 
        $objet = new ModelSaison();
        $objet->setIdSaison($donnees[$i]['id']);
        $objet->setSaison($donnees[$i]['name']);
        $data[] = $objet;
      }
      return $data;
    }
  }
?>