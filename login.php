<?php 

ob_start();

include "partials/header.php";
include "config/db.php";

// NOTRE LOGIN
        

// 1) On vérifie que le form ait été soumis avec POST et que le bouton de submit ait été cliqué
if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_POST["submit"]))) {

  // 2) On vérifie que tous les champs soient remplis
  if (!empty($_POST["email"]) || !empty($_POST["password"])) {

    // 3) On vient vérifier que le mail soit au bon format
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

      $email = $_POST["email"];

      // 4) On va chercher en BDD le user qui correspond à l'email (requete préparée) +
      // Si on trouve personne on affiche un message d'erreur 
      $sql = "SELECT * FROM users WHERE email = ?";

      $stmt = $pdo->prepare($sql);
      $stmt->execute([$email]);
      $user = $stmt->fetch();
      
      if ($user) {

        // Si on trouve bien une personne on vient vérifier son mot de passe (voir la fonction password_verify)
        $password = $_POST["password"];
        $hash = $user["password_hash"];

        // On vient comparer le mdp donné par le user avec celui de la BDD (password_hash)
        if (password_verify($password, $hash)) {

          // Pour connecter le user et démarrer une session on va utiliser session_start()
          session_start(); 

          // J'inclus dans la suprglobale $_SESSION, les infos du user que je récupère de la BDD
          $_SESSION = $user;

          // 5) Si le mdp est bon, on redirige vers la homepage (On redirige avec Header("Location: ma-page.php"))
          Header("Location: index.php");

          ob_flush();

        } else {

          $error = "Mot de passe incorrect";
        }
      } else {

        $error = "Désolé votre compte n'existe pas";
      }
    } else {

      $error = "Attention le mail n'est pas au bon format";
    }
  } else {

    $error = "Veuillez remplir tous les champs";
  }
}

?>



<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-24 w-24 w-auto" src="assets/logo_2.webp" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="#" method="POST">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <button name="submit" type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>

  </div>
</div>



<?php 

include "partials/footer.php";

?>

