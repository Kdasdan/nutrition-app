<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Acces-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require  '../services/Bdd.php';
    require  '../models/PassRecovery.php';
    require  '../services/PassRecovery.php';

    $donnees = json_decode(file_get_contents("php://input"));   

    if(!empty($donnees->password) && !empty($donnees->hash)){
      $password = htmlspecialchars($donnees->password);
      $hash = htmlspecialchars($donnees->hash);
      $hash = str_replace("11-","/", $hash);
    
      $model = new ModelRecovery();
      $model->setHash($hash);
      
      $serviceRecovery = new ServiceRecovery();
      $objet = $serviceRecovery->getRecovery($model);

      if($objet){
        $objet->setPass(password_hash($password,PASSWORD_DEFAULT));
        $recovery = $serviceRecovery->setRecovery($objet);
      }else {
        var_dump(false);
      }
    }

}

?>