<?php
  class ServiceTarifs extends Bdd{
    function getOffer($formule){
      $bdd = (new Bdd())->connexion();
      $req = $bdd->prepare('SELECT * FROM offer WHERE id_formula = :id');
      $req->execute(array(
        'id' => $formule
      ));
      $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
      for ($i=0; $i <count($donnees) ; $i++) { 
        $objet = new ModelTarifs();
        $objet->setID($donnees[$i]['id']);
        $objet->setIdFormule($donnees[$i]['id_formula']);
        $objet->setTitle($donnees[$i]['title']);
        $objet->setSubTitle($donnees[$i]['sub_title']);
        $objet->setDescription($donnees[$i]['description']);
        $objet->setPrice($donnees[$i]['price']);
        $data[] = $objet;
      }
      return $data;
    }
  }
?>