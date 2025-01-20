<?php 

include "partials/header.php";
include "config/curl.php";

?>

<h1 class="text-center">
    Bienvenue sur la page shop
</h1>


    <section class="shop">

        <?php foreach($decoded as $item) : ?>

            <div class="product">
                <img src="<?= $item->images[0] ?>">
                <h3><?= $item->title ?></h3> 
                <h3><?= $item->price ?></h3>
                <h4><?= $item->description ?></h4>
            </div>


        <?php endforeach ?>

    </section>


<?php 

include "partials/footer.php";

?> 