<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/service.php";


//require_once __DIR__ . "/templates/header.php";

$cars = getArticles($pdo);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/actualites.css">
    <title>Document</title>
</head>
<body>
    <!-- navbar -->
    <header>

        <!-- <h1>GARAGE DE VINCENT PERROT</h1> -->
        <!-- vav container -->
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

        <div class=" cars-container container">
            <!--box cars" id="cars -->
            <?php foreach ($cars as $key => $car) { ?>
                <?php require __DIR__ . "/templates/article_part.php" ?>
            <?php } ?>
        </div>
    </main>

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
                    <h3>Contact</h3>
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
    <!-- link to js -->
    <script src="../JS/index.js"></script>
</body>

</html>