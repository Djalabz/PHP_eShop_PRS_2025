<?php 

include "partials/header.php";
include "config/curl.php";

// On va reprendre le mécanisme ci-dessous sauf que le tableau des items du caddie (leur id)
// sera sauvergardé dans les cookies. On utilisera la superglobale $_COOKIE

if (isset($_GET["item"])) {
    // Donc enlever cette ligne et la remplacer par les instructions adéquates 
    // pour enregistrer dans les Cookies
    if (!isset($_COOKIE["cart"])) {

        $ids = [];
        $ids[] = $_GET["item"];
        $ids = json_encode($ids);
        setcookie("cart", $ids, time() + 60 * 10);

    } else {

        $ids = json_decode($_COOKIE["cart"]);

        var_dump($ids);

        $ids[] = $_GET["item"];
        $ids = json_encode($ids);
        

        var_dump($ids);


        setcookie("cart", $ids, time() + 60 * 10);
    }
   

    

    
}

?>

<h1>Page du panier</h1>

<section class="cart">

    <!-- Ici afficher une phrase du type "Le panier contient XX articles" -->

    <?php foreach($decoded as $item) : ?> 

        <?php if (in_array($item->id, json_decode($_COOKIE["cart"]))) : ?>

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