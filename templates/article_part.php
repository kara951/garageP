<?php
        if ($car["image"] === null){
            $imagePath = "assets/images/car5.jpg";
        }else{
            $imagePath = "uploads/cars".$car["image"];
        }
?>

    <div class="box">
    <img src="<?=$imagePath ?>" alt="images-default">
        <!-- /Applications/XAMPP/xamppfiles/htdocs/Garage/assets/images/car5.jpg -->
        <a href="actualite.php?id=<?=$car["id"] ?>">Lire la suite<i class='bx bx-right-arrow-alt'></i></a>
    </div>



<?php
        if ($service["image"] === null){
            $imagePath = "assets/images/part1.png";
        }else{
            $imagePath = "uploads/cars".$car["image"];
        }
?>



