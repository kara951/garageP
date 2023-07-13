<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/car.php";
require_once __DIR__ . "/lib/service.php";



$error = false;
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $car = getCarById($pdo, $id);
    if ($car["image"] === null) {
        $imagePath = _ASSETS_IMAGES_FOLDER_ . "assets/images/default-car.jpg";
    } else {
        $imagePath =  _CARS_IMAGES_FOLDER_ . $car["image"];
    }

    if (!$car) {
        $error = true;
    }

    $artcle = getArticleById($pdo, $id);
    if ($article['imag'] === null) {
        $imagePath = _ASSETS_IMAGES_FOLDER_ . "assets/imageProduit/part1.png";
    } else {
        $imagePath = _ARTICLES_IMAGES_FOLDER_ . $articles['image'];
    }
} else {
    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/actualite.css">
    <title>A propos</title>
</head>

<body>
    <header>
        <!-- <h1>GARAGE DE VINCENT PERROT</h1> -->
        <!-- nav container -->
        <div class="nav container">
            <!-- <img width="15" src="./assets/images/logo-tech-trendz.png" alt="logo-garage"> -->
            <!-- menu Icon -->
            <i class='bx bx-menu' id="menu-icon"></i>
            <!-- Logo -->
            <a href="#" class="logo">Car<span>Point</span></a>
            <!-- nav liste -->
            <ul class="navbar">
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="services.php">Nos services</a></li>
                <li><a href="actualites.php">Nos vehicules</a></li>
                <li><a href="a_propos.php">A Propos</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">se connecter</a></li>
                <!-- <li><a href="inscription.php">Inscription</a></li> -->
            </ul>
            <!-- search icon -->
            <i class='bx bx-search' id="search-icon"></i>
            <!-- search box -->
            <div class="search-box container">
                <input type="search" name="" id="" placeholder="search here ...">
            </div>
        </div>
    </header>

    <main>
        <!-- Home section-->
        <section class="home" id="home">
            <div class="home-text">
                <h1>We Have everything <br> Your <span>Car</span> Need</h1>
            </div>
        </section>

        <?php if (!$error) { ?>
            <!-- Home section-->
            <section class="blog" id="blog">
                <div class="heading">
                    <span>Blog & News </span>
                    <h2>Our Blog content</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, mollitia.</p>
                </div>
                <div class="blog-container  container">
                    <div class="box">
                        <!-- Page d'article -->
                        <!-- <img src="<? //= $imagePath; 
                                        ?>" alt="car"> -->
                        <img src="uploads/cars/<?= $car['image'] ?>" alt="default " width="100px;">
                        <h3><br><?= htmlentities($car["title"]); ?></h3>
                        <p><?= htmlentities($car["modele"]) ?></p>
                        <p><?= htmlentities($car["annee"]) ?></p>
                        <p><?= htmlentities($car["kilometre"]) ?></p>
                        <p><?= htmlentities($car["vitesse"]) ?></p>
                        <p><?= htmlentities($car["color"]) ?></p>
                        <p><?= htmlentities($car["place"]) ?></p>
                        <p><?= htmlentities($car["porte"]) ?></p>
                        <p><?= htmlentities($car["puissance"]) ?></p>
                        <p><?= htmlentities($car["carburant"]) ?></p>
                        <p><?= htmlentities($car["prix"]) ?></p>
                        <p><?= htmlentities($car["content"]); ?></p>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <h2>Article introuvable</h2>
        <?php } ?>

        <!-- Footer -->
        <footer>
            <section class="footer">
                <div class="footer-container container">
                    <div class="footer-box">
                        <a href="#" class="logo">Car<span>Point</span></a>
                        <div class="social">
                            <a href="#"><i class='bx bxl-facebook'></i></a>
                            <a href="#"><i class='bx bxl-twitter'></i></a>
                            <a href="#"><i class='bx bxl-instagram'></i></a>
                            <a href="#"><i class='bx bxl-youtube'></i></a>
                        </div>
                    </div>
                    <div class="footer-box">
                        <h3>Page</h3>
                        <a href="#">Home</a>
                        <a href="#">Cars</a>
                        <a href="#">Parts</a>
                        <a href="#">Sales</a>
                    </div>
                    <div class="footer-box">
                        <h3>Legal</h3>
                        <a href="#">Privacy</a>
                        <a href="#">Refund Policy</a>
                        <a href="#">Cookie Policy</a>
                    </div>
                    <div class="footer-box">
                        <!-- <h3>Contact</h3> -->
                        <li><a href="contact.php">Contact</a></li>
                        <p>United states</p>
                        <p>Japan</p>
                        <p>Germany</p>
                    </div>
                </div>
            </section>
        </footer>

        <!-- copyright -->
        <div class="copyright">
            <p>&#169; CarpoolVenom All Right Reserved</p>
        </div>

        <script src="../JS/index.js"></script>

</body>

</html>