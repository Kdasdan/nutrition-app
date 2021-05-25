<?php
  require '../../vendor/autoload.php';
  use \Mailjet\Resources;
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acces-Control-Allow-Methods: POST');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $donnees = json_decode(file_get_contents("php://input"));
        
        if(!empty($donnees->name) && !empty($donnees->email) && !empty($donnees->objet) && !empty($donnees->message)){
          
          $name = htmlspecialchars($donnees->name);
          $email = htmlspecialchars($donnees->email);
          $objet = htmlspecialchars($donnees->objet);
          $message = htmlspecialchars($donnees->message);

          $mj = new \Mailjet\Client('4ab9cf2954e2d07805eafbc3e8f8e4f4','8ba2be174ed04d5a6f2d105bd9faebb0',true,['version' => 'v3.1']);
          $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "a.iffli@hotmail.fr",
                  'Name' => $name
                ],
                'To' => [
                  [
                    'Email' => 'dasdankazim@gmail.com',
                    'Name' => ""
                  ]
                ],
                'Subject' => $objet,
                'HTMLPart' => "<p>".$message."</p><p> Pour me répondre veuillez me contacter a l'adresse mail ci-dessous : </p><p>".$email."</p><p>Cordialement ".$name."<p>",
                'CustomID' => "AppGettingStartedTest"
              ]
            ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);


        }


  }
?>