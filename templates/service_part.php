<?php

if ($service["image"] === null) {
    $imagePath =  "assets/imageProduit/part1.png";
    //_ASSETS_IMAGES_FOLDER_ . "assets/images/default-car.jpg";
} else {
    $imagePath =  "uploads/services/" . $service['image'];
    //_CARS_IMAGES_FOLDER_ . $car["image"];
}
?>



<div class="box">
    <img src="<?= $imagePath ?>" alt="images-default">
    <h3><?= $service["title"] ?></h3>
    <p><?= $service["content"] ?></p>
    <span><?= $service["star"] ?></span>
    <span><?= $service["prix"] ?></span>
    <a href="contact.php?id=<?= $service["id"] ?>">Contactez-nous<i class='bx bx-right-arrow-alt'></i></a>
</div>