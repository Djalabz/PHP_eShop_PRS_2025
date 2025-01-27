<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
include "contact.php";
include "env.php";

// Comme d'hab on vérifie que le form du contact.php (inclus au dessus) ait bien été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

  // On vérirife que les champs ne soient pas vides 
  if (!empty($_POST["email"]) || !empty($_POST["username"]) || !empty($_POST["subject"]) || !empty($_POST["message"])) {

      // On vérifie que l'email est bien au bon format 
      if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

          // On vient donner des noms de variables aux éléménts que l'on recup depuis le formulaire 
          $email = $_POST["email"];
          $username = htmlspecialchars($_POST["username"]);
          $subject = htmlspecialchars($_POST["subject"]);
          $message = htmlspecialchars($_POST["message"]);
      
          // ET ENFIN
          // Quand on a bien vérifié les infos on vient instancier PHPMailer 
          // ET y edéfinir nos configurations 

          // Instanciation de PHP_Mailer = on créée un objet mail qui contiendra les propriétés et méthodes de la classe 
          // PHPMailer
          $mail = new PHPMailer(true);

          try {
              // Configuration et infos du serveur                 
              $mail->isSMTP();   // Ici on précise qu'on utilise SMTP (Simple Mail Transfer Protocol)
              $mail->Host       = 'smtp.gmail.com';  // On précise le nom du serveur SMTP (pour nous gmail)
              $mail->Port       = 465; // Ici le port pour SMTP, soit 465 avec SSL, ou 587 avec TLS
              $mail->SMTPAuth   = true;   // On confirme utiliser l'authentification SMTP
              $mail->Username   = $_ENV["email"];  // Ici notre email (qui va recevoir l'email du user)
              $mail->Password   = $_ENV["password"]; // Ici notre mdp généré par Google (lors de l'étape de création de l'app dans gmail)
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // On permet le chiffrement SMTP           

              //Recipients
              $mail->setFrom($_POST["email"], $_POST["username"]); // Ici le mail et le username du User qui envoi le mail
              $mail->addAddress($mail->Username, "Romain Jalabert");  // Ici notre mail ainsi que notre nom
            //Optional name

              //Content                               
              $mail->Subject = $_POST["subject"]; // Le sujet du message 
              $mail->Body    = $_POST["message"]; // Le corpqs du message 

              // On peut finalement envoyer notre mail 
              $mail->send();

              // Redirection vers une page de succès
              header("Location: contact-success.php");
              exit;

          } catch (Exception $e) {
              // dans ce bloc catch, on gère les erreurs as usual
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
      }  else {
          $error = "Veuillez entrer un email valide";
      }
  } else {
      $error = "Veuillez remplir tous les champs";
  }
}

