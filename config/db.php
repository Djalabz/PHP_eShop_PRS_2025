<?php 
// PAGE DE CONNEXION A LA BASE DE DONNEES avec PDO

try {

    // Ici nous avons le data source name (ou dsn) qui contient les infos relatives à notre BDD
    $dsn = "mysql:dbname=eshop;host=localhost";

    // Ici on définit nos options, juste une pour le moment qui vient faire ensorte que l'on 
    // récupère par défaut depuis la BDD les infos sous formes de tableau associatif (fetch_assoc)
    $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

    // Nos identifiants de connexion à la BDD : uset et mdp
    $user = "root";
    $password = "";

    // Je créee une variable de connexion $pdo
    $pdo = new PDO($dsn, $user, $password, $options);

    // echo "Je suis bien connecté à ma BDD !";

} catch(PDOException $error) {

    // Si il y a une erreur (ici $error) alors on affiche celle-ci àl'aide de $errort->getMessage()
    die("Il y a une erreur : " . $error->getMessage());
}


?>