<?php

if ($article["image"] === null) {
    $imagePath =  "assets/imageProduit/part1.png"; 
    //_ASSETS_IMAGES_FOLDER_ . "assets/images/default-car.jpg";
} else {
    $imagePath =  "uploads/articles/" . $article['image'];
    //_CARS_IMAGES_FOLDER_ . $car["image"];
}
?>



<div class="parts-container container">
    <div class="box">
        <img src="<?= $imagePath ?>" alt="images-default">
        <!-- /Applications/XAMPP/xamppfiles/htdocs/Garage/assets/images/car5.jpg -->
        <h3><?= $article["title"] ?></h3>
        <p><?= $article["annee"] ?></p>
        <p><?= $article["kilometre"] ?></p>
        <p><?= $article["carburant"] ?></p>
        <p><?= $article["boiteV"] ?></p>
        <span><?= $article["prix"] ?></span>
        <a href="actualite.php?id=<?= $article["id"] ?>">Lire la suite<i class='bx bx-right-arrow-alt'></i></a>
    </div>
</div>