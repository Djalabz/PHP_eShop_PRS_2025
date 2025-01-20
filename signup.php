<?php 

include "partials/header.php";
include "config/db.php";

// On va s'occuper du Signup : 

// On vérifie que la méthode est bien POST et que le form ait bien été soumis
if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_POST["submit"]))) {

    // On vérifie que les champs ne soient pas vide 
    if (!empty($_POST["username"]) || !empty($_POST["email"]) || !empty($_POST["password"]) || !empty($_POST["confirm"])) {

        // Vérification de l'email 
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        
            $username = htmlspecialchars($_POST["username"]);
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm = $_POST["confirm"];

            // Je viens vérifier que les mots de passe soient les memes
            if ($password === $confirm) {

              // Je peux désormais vérifier que le user n'existe dèjà pas en BDD, notamment via son email
              // On vérifie également que le username ne soit pas déjà utilisé
              $sql = "SELECT * FROM users WHERE email = ? OR username = ?";

              // Les 3 étapes afin d'éxecuter une requete préparée à l'aide de $pdo (qui est dans notre fichier db.php)
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$email, $username]);
              $user = $stmt->fetch();  

              // Si on ne trouve personne alors on peut poursuivre et enregistrer le nouveau user en BDD
              if (!$user) {

                // On va hasher (créér une empreinte cryptographique) le mot de passe avant d'ajouter le user en BDD
                $hash = password_hash($password, PASSWORD_DEFAULT); // Hache le password avec bcrypt (gère le sel automatiquement)
                
                $sql = "INSERT INTO users(username, email, password_hash) VALUES(?, ?, ?)";

                // On tente d'insérer un user dans un try et si tout se passe bien on affiche un message   
                try {
                  // Les 3 étapes afin d'éxecuter une requete préparée à l'aide de $pdo (qui est dans notre fichier db.php)
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute([$username, $email, $hash]);

                  echo "Utilisateur $username ajouté avec succès !";

                  // Si il y a un souci on affiche l'erreur en question
                } catch(PDOException $error) {

                  echo "Erreur : $error";

                }
                
              // Si on trouve le username ou l'email en BDD alors on affiche une erreur 
              } else if ($user && $user["username"] === $username) {

                $error = "Username déjà pris";

              } else if ($user && $user["email"] === $email) {

                $error = "Email déjà pris";
              }

            } else {
              $error = "Les mots de passe doivent etre similaires";

            }

        } else {

          $error = "Votre email n'est pas au bon format";

        }
    } else {
        // On affiche l'erreur si un des champs n'est pas rempli 
        $error = "Veuillez remplir tous les champs";
    }
    
}

?>

<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-24 w-24 w-auto" src="assets/logo_2.webp" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create an account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    <!-- Ci-dessous notre formulaire en POST -->
    <form class="space-y-6" method="POST">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="text" name="email" id="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
        <div class="mt-2">
          <input type="text" name="username" id="username" autocomplete="username"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="current-password"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
        <label for="password" class="block text-sm/6 font-medium text-gray-900">Confirm your Password</label>
        <div class="mt-2">
          <input type="password" name="confirm" id="confirm" autocomplete="current-password"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign up</button>
      </div>
    </form>

    <!-- Ici on affiche les potentielles erreur -->
    <?php if (isset($error)) : ?>

        <h2><?= $error ?></h2>

    <?php endif ?>

  </div>
</div>

<?php 

include "partials/footer.php";


// Vérification des MDP 

// Ci-dessous la vérification des mdp par rapport à la CNIL

// La regex pour vérifier que le mdp contient bien une maj au moins, une min au moins, 
// un chiffre et un car spécial, le tout doit faire 12 car min.
// $regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{12,}$/";

// Ici on vérifie que le mdp soit conforme (min, maj etc)
// if (!preg_match($regex, $_POST["password"])) {
//     $error = "Le mot de passe ne respecte pas les consignes de la CNIL";

// // On vérifie que les mdp soient les memes 
// } else if ($_POST["password"] !== $_POST["confirm"]) {
//     $error = "Les mots de passe doivent etre identiques";

// // Si pas d'erreur on crée notre variable password 
// } else {
//     $password = $_POST["password"];
// }

?>




