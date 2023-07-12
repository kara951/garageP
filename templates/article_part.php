<?php

if ($car["image"] === null) {
    $imagePath = _ASSETS_IMAGES_FOLDER_ . "default-article.jpg";
} else {
    $imagePath =  _CARS_IMAGES_FOLDER_ . $car["image"];
}
?>

<!-- <div> -->
<div class="box">
    <img src="<?= $imagePath ?>" alt="<?= htmlentities($car["title"]) ?> ">
    <!-- <div> -->
    <h3 class="card-title"><?= htmlentities($car["title"]) ?></h3>
    <span><?= htmlentities($car["modele"]) ?><br></span>
    <span><?= htmlentities($car["annee"]) ?><br></span>
    <span><?= htmlentities($car["kilometre"]) ?><br></span>
    <span><?= htmlentities($car["vitesse"]) ?><br></span>
    <span><?= htmlentities($car["color"]) ?><br></span>
    <span><?= htmlentities($car["place"]) ?><br></span>
    <span><?= htmlentities($car["porte"]) ?><br></span>
    <span><?= htmlentities($car["puissance"]) ?><br></span>
    <span><?= htmlentities($car["carburant"]) ?><br></span>
    <span><?= htmlentities($car["prix"]) ?><br></span>

    <a href="actualite.php?id=<?= $car["id"] ?>">Détails<i class='bx bx-right-arrow-alt'></i></a>
    <!-- </div> -->
</div>
<!-- </div> -->