<?php
  require '../../vendor/autoload.php';
  use \Mailjet\Resources;
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=utf-8');
  header('Acces-Control-Allow-Methods: POST');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

      require  '../services/Bdd.php';
      require  '../models/Account.php';
      require  '../services/PassForget.php';

      $donnees = json_decode(file_get_contents("php://input"));   

      if(!empty($donnees->mail)){
        $mail = htmlspecialchars($donnees->mail);
      
        $objet = new Account();
        $objet->setMail($mail);
        $verif = (new ServiceForget())->forget($objet);

        if ($verif){
          $hash = password_hash($verif->getID(), PASSWORD_DEFAULT);
          $hash = str_replace("/","11-", $hash);

          $mj = new \Mailjet\Client('4ab9cf2954e2d07805eafbc3e8f8e4f4','8ba2be174ed04d5a6f2d105bd9faebb0',true,['version' => 'v3.1']);
          $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "a.iffli@hotmail.fr",
                  'Name' => "vr_nutrition"
                ],
                'To' => [
                  [
                    'Email' => $verif->getMail(),
                    'Name' => ""
                  ]
                ],
                'Subject' => "Réinitialisation du mot de passe",
                'HTMLPart' => "<h3>Veuillez trouvez ci-joint votre lien de réinitialisation : </3><br /><br /><a href='http://localhost:8080/reinitialisation/".$hash."'>Cliquez ici !</a><br /><br />Si vous n'êtes pas à l'origine de cette démarche veuillez ne pas en tenir compte.",
                'CustomID' => "AppGettingStartedTest"
              ]
            ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);

        }else{
          var_dump($verif);
        }
      }

  }

?>