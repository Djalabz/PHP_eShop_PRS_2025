<?php 

include "partials/header.php";
include "config/curl.php";

// On va reprendre le mécanisme ci-dessous sauf que le tableau des items du caddie (leur id)
// sera sauvergardé dans les cookies.

if (isset($_GET["item"])) {
    echo $_GET["item"];
    // Ajouter l'id de l'item en SESSION ou en COOKIES
    $itemIds[] = $_GET["item"];
}

?>

<h1>Votre page de caddie</h1>

<section class="cart">

    <?php foreach($decoded as $item) : ?> 
        <?php if (in_array($item->id, $itemIds)) : ?>

            <div class="product">
                <p><?= $item->id ?></p>
                <img src="<?= $item->images[0] ?>">
                <h3><?= $item->title ?></h3> 
                <h3><?= $item->price . " $"?></h3>
                <h4><?= substr($item->description, 0, 120) . " ..." ?></h4>

                
                <a href="#">
                    <button class="rounded border border-black px-2 py-1">Supprimer du panier</button>
                </a>

            </div>
        <?php endif ?>
    <?php endforeach ?>

</section>

<?php 

include "partials/footer.php";

?>