<?php 


session_start();

include "partials/header.php";
include "config/db.php";





?>

<h1 class="animate animate__animated animate__fadeInLeft text-center">Bienvenue <?= $_SESSION["username"] ?> !</h1>
<h2 class="animate animate__animated animate__fadeInLeft text-center">Votre email est <?= $_SESSION["email"] ?> !</h2>

<?php 

include "partials/footer.php";

?>

