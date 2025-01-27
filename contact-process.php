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


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

  if (!empty($_POST["email"]) || !empty($_POST["username"]) || !empty($_POST["subject"]) || !empty($_POST["message"])) {

      if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

          $email = $_POST["email"];
          $username = htmlspecialchars($_POST["username"]);
          $subject = htmlspecialchars($_POST["subject"]);
          $message = htmlspecialchars($_POST["message"]);
      
          //Create an instance; passing `true` enables exceptions
          $mail = new PHPMailer(true);

          try {
              //Server settings                     
              $mail->isSMTP();                                            //Send using SMTP
              $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
              $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
              $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
              $mail->Username   = $_ENV["email"];                     //SMTP username
              $mail->Password   = $_ENV["password"];                               //SMTP password
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

              //Recipients
              $mail->setFrom($_POST["email"], $_POST["username"]);
              $mail->addAddress($mail->Username, "Romain Jalabert");        //Name is optional
            //Optional name

              //Content                               //Set email format to HTML
              $mail->Subject = $_POST["subject"];
              $mail->Body    = $_POST["message"];

              $mail->send();

              echo "Message has been sent to $mail->Username";

          } catch (Exception $e) {

              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
      }  else {
          $error = "Veuillez entrer un email valide";
      }
  } else {
      $error = "Veuillez remplir tous les champs";
  }
}

