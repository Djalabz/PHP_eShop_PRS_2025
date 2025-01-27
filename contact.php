<?php 

include "partials/header.php"

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    if (!empty($_POST["email"]) || !empty($_POST["username"]) || !empty($_POST["subject"]) || !empty($_POST["message"])) {

       $email = $_POST["email"];
       $username = $_POST["username"];
       $subject = $_POST["subject"];
       $message = $_POST["message"];

    } else {
        $error = "Veuillez remplir tous les champs";
    }
}

?>


<section class="contact w-[600px] mx-auto">

    <h1 class="text-center mb-10 font-bold">Page de contact</h1>
    
    <form class="flex flex-col" action="#" method="POST">
    
        <label for="email">Votre email :</label>
        <input class="border mb-4" id="email" type="email" name="email">
    
        <label for="username">Votre nom de user :</label>
        <input class="border mb-4"  type="text" id="username" name="username">
    
        <label for="subject">L'objet de votre message</label>
        <input class="border mb-4" type="text" id="subject" name="subject">
    
        <label for="message">Votre message :</label>
        <textarea class="border mb-4 h-32" name="message" id="message"></textarea>
    
        <input class="border bg-blue-200 py-2 px-4 cursor-pointer" type="submit" name="submit" value="Envoyer">
    
    </form>

</section>




<?php 

include "partials/footer.php"

?> 