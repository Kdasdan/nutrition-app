<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: GET');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

  if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['email']) AND isset($_GET['pass']) AND !empty($_GET['email']) AND !empty($_GET['pass'])
    ){
      $email = htmlspecialchars($_GET['email']);
      $pass = htmlspecialchars($_GET['pass']);
    
      require  '../services/Bdd.php';
      require  '../models/Account.php';
      require  '../services/Connect.php';

      $connect = new Account();
      $connect->setMail($email);
      $connect->setPass($pass);

      $objet = (new ServiceConnect())->connect($connect); 

      
      if($objet){
        $data = [
          'id' => $objet->getID(),
          'level' => $objet->getLevel(),
          'mail' => $objet->getMail(),
          'pass' => $objet->getPass(),
          'name' => $objet->getName(),
          'surname' => $objet->getSurname(),
          'tel' => $objet->getTel()
        ];
        echo json_encode($data);
      }
    }
  }
?>