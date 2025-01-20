<?php 

include "partials/header.php";
include "config/curl.php";

?>

<h1 class="text-center">
    Bienvenue sur la page shop
</h1>


    <section class="grid grid-cols-4 mt-12 gap-x-6 gap-y-6 shop">

        <!-- On récupère la variable $decoded (car le fichier curl est inclus en haut)
        Cette variable est un tableau on peut donc utiliser foreach pour le parcourir -->
        <?php foreach($decoded as $item) : ?>

            <!-- La div qui va afficher les items ed notre store -->
            <div class="product">
                <img src="<?= $item->images[0] ?>">
                <h3><?= $item->title ?></h3> 
                <h3><?= $item->price . " $"?></h3>
                <h4><?= substr($item->description, 0, 120) . " ..." ?></h4>
                <button class="rounded border border-black px-2 py-1">Ajouter au panier</button>
            </div>


        <?php endforeach ?>

    </section>


<?php 

include "partials/footer.php";

?> 