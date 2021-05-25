<?php 

  // require 'Bdd.php';
  // require '../models/Recettes.php';
  class ServiceRecettes extends Bdd {

    function getRecettes($objet) {
      $bdd = (new Bdd())->connexion();
      
      $req = $bdd->prepare(
        'SELECT
          recipies_site.id rsid, 
          image img,
          title,
          file_name fn
        FROM
          recipies_site 
        INNER JOIN
          recipie_season rs
        ON 
          rs.id = recipies_site.id_season
        INNER JOIN 
          recipie_category rc
        ON 
          rc.id = recipies_site.id_category
        WHERE 
          rs.name = :name_season
        AND
          rc.name = :name_category'
      );
      $req->execute(array(
        'name_season' => $objet->getSeason(),
        'name_category' => $objet->getCategory()
      ));
      
      $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
      
      if($donnees) {
        for ($i=0; $i < count($donnees); $i++) { 
          $result = new ModelRecettes();
          $result->setID($donnees[$i]['rsid']);
          $result->setImage($donnees[$i]['img']);
          $result->setTitle($donnees[$i]['title']);
          $result->setFileName($donnees[$i]['fn']);
          $data[] = $result;
        }
        return $data;
      }  
    }
  }

  // $test = new ModelRecettes();
  // $test->setSeason('Printemps');
  // $test->setCategory('Chauds');

  // $data = (new ServiceRecettes())->getRecettes($test);

  // class Recette {
  //   public $id;
  //   public $title;
  //   public $image;
  //   public $file;

  //   function __construct($id, $title, $image, $file) { 
  //     $this->id = $id;
  //     $this->title = $title;
  //     $this->image = $image;
  //     $this->file = $file;
  //   }
  // }
  // for ($i=0; $i < count($data); $i++) { 
  //   $objet = new Recette($data[$i]->getID(),$data[$i]->getTitle(),$data[$i]->getImage(),$data[$i]->getFileName());
  //   $result[] = $objet;
  // }
  
  // var_dump(json_encode($result));
?>