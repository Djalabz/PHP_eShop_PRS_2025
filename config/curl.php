<?php

// CURL avec PHP
// Dans ce fichier curl.php on va communiquer (grace à curl) avec une API (Platzi Fake Store)

// Pour communiquer avec une API on aura besoin d'un "endpoint" cad un lien qui va nous renvoyer
// les infos désirées sous le format JSON.

// Le JSON est le format de prédilection pour envoyer ou recevoir des données vers une API.
// Il conviendra donc de le traduire (JSON->Tableau associatif) afin d'utiliser les données recues.

// On initialise une "session" curl -> on démarre l'outil
$ch = curl_init();

// On vient préciser l'URL duquel on va récupérer nos données (ici nos produits pour le shop)
$url = 'https://api.escuelajs.co/api/v1/products';
// $url = "https://fakestoreapi.com/products";

// Mettre en place les options pour CURL

// Ici on précise l'URL de destinantion, ou endpoint
curl_setopt($ch, CURLOPT_URL, $url);
// Ici on s'assure de récupérer des chaines de caractères depuis le endpoint
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// On vient finalement éxecuter notre requete
$resp = curl_exec($ch);

// On vient décoder la réponse depuis JSON que l'on place dans la variable $decoded
$decoded = json_decode($resp);

// J'affiche ce qu'on récupère de l'API
// echo "<pre>";
// print_r($decoded);
// echo "</pre>";

// Par bonne pratique, une fois notre requete effectuée on clot la connexion
curl_close($ch);

?>