<?php 

session_start();

include "partials/header.php";
// include "config/db.php";

?>


<?php if (isset($_SESSION["username"])) : ?>


<h1 class="animate animate__animated animate__fadeInLeft text-center">Bienvenue <?= $_SESSION["username"] ?> !</h1>
<h2 class="animate animate__animated animate__fadeInLeft text-center">Votre email est <?= $_SESSION["email"] ?> !</h2>


<?php else : ?>
    
<h1 class="text-center">Bienvenue, veuillez vous login !</h1>

<?php endif ?>

<?php 

include "partials/footer.php";

?>

