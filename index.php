<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/car.php";
require_once __DIR__ . "/lib/session.php";

// info base de données
$cars = getCars($pdo, 3);

// À REPRNDRE ICI DEMAIN INCHALLAH

//$cars = getService($pdo, 3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <!-- navbar -->
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
                <!-- <li><a href="actualites.php">Actualités</a></li> -->
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
                <h1>Vous êtes à la Page <br> d'accueil du <span>GARAGE</span> Mr PARROT</h1>
            </div>
        </section>


        <!-- Cars container -->
        <section class="cars" id="cars">
            <div class="heading">
                <span>Nos vehicules</span>
                <h2>Vous avez tout types de vehicules</h2>
                <p>Pour plus de renseignement n'hésitez pas à nous contacter.</p>
            </div>
            <!-- Cars container -->
            <div class="cars-container container">
                <!-- box1 -->
                <?php foreach ($cars as $key => $car) { ?>
                    <?php require __DIR__ . "/templates/article_part.php" ?>
                <?php } ?>
            </div>
        </section>


        

        <!-- Parts section -->
        <section class="parts" id="parts">
            <div class="heading">
                <span>PRESTATIONS DANS NOS CENTRES</span>
                <h2>PRESTATIONS DANS NOS CENTRES</h2>
                <p>Retrouver toutes les listes en un click</p>
            </div>
            <!-- Parts Container -->
            <div class="parts-container container">
                <!-- box1 -->
                <div class="box">
                    <?php foreach ($services as $key => $service) { ?>
                        <?php require __DIR__ . "/templates/article_part.php" ?>
                    <?php } ?>
                </div>
            </div>
        </section>






        <!-- ============================================================================ -->
        <!-- Nos prestations -->
        <!-- Parts section -->
        <section class="parts" id="parts">
            <div class="heading">
                <span>PRESTATIONS DANS NOS CENTRES</span>
                <h2>PRESTATIONS DANS NOS CENTRES</h2>
                <p>Retrouver toutes les listes en un click</p>
            </div>
            <!-- Parts Container -->
            <div class="parts-container container">
                <!-- box1 -->
                <div class="box">
                    <img src="./uploads/parts/part1.png" alt="part1">
                    <h3>Moteur</h3>
                    <span>1200€</span>
                    <i class='bx bxs-star'>(6 Review)</i>
                    <a href="#" class="btn">Buy Now</a>
                    <a href="#" class="details">View Details</a>
                </div>
                <!-- box2 -->
                <div class="box">
                    <img src="./uploads/parts/part2.png" alt="part2">
                    <h3>Frein moteur</h3>
                    <span>170€</span>
                    <i class='bx bxs-star'>(6 Review)</i>
                    <a href="#" class="btn">Buy Now</a>
                    <a href="#" class="details">View Details</a>
                </div>
                <!-- box3 -->
                <div class="box">
                    <img src="./uploads/parts/part3.png" alt="part3">
                    <h3>Suspention</h3>
                    <span>208.55€</span>
                    <i class='bx bxs-star'>(6 Review)</i>
                    <a href="#" class="btn">Buy Now</a>
                    <a href="#" class="details">View Details</a>
                </div>
                <!-- box4 -->
                <div class="box">
                    <img src="./uploads/parts/part4.png" alt="part4">
                    <h3>Filtre à gaziol</h3>
                    <span>82.99€</span>
                    <i class='bx bxs-star'>(6 Review)</i>
                    <a href="#" class="btn">Buy Now</a>
                    <a href="#" class="details">View Details</a>
                </div>
                <!-- box5 -->
                <div class="box">
                    <img src="./uploads/parts/part5.png" alt="part5">
                    <h3>Kit embrayage</h3>
                    <span>670€</span>
                    <i class='bx bxs-star'>(6 Review)</i>
                    <a href="#" class="btn">Buy Now</a>
                    <a href="#" class="details">View Details</a>
                </div>
                <!-- box6 -->
                <div class="box">
                    <img src="./uploads/parts/part6.png" alt="part6">
                    <h3>Pneu</h3>
                    <span>223€</span>
                    <i class='bx bxs-star'>(6 Review)</i>
                    <a href="#" class="btn">Buy Now</a>
                    <a href="#" class="details">View Details</a>
                </div>
            </div>
        </section>


        <!-- Blog Contenair -->
        <section class="blog" id="blog">
            <div class="heading">
                <span>Blog & Nouveaux </span>
                <h2>Nos vehicules d'occasions</h2>
                <p>Nos vehicules d'occasions sont disponible en clik</p>
            </div>
            <!-- Blog Contenair -->
            <div class="blog-container  container">
                <!-- box1 -->
                <div class="box">
                    <a href="#"><img src="./uploads/cars/car1.jpg" alt="car-blog"></a>
                    <h3>Clio 3</h3>
                    <span>Année: 2022</span>
                    <p>Kilométrage: 150000 km</p>
                    <p>Carburant: Diesel</p>
                    <p>Boîte de vitesse: Automatique</p>
                    <a href="#" class="blog-btn">Read More<i class='bx bx-right-arrow-alt'></i></a>
                    <span>1200.99€</span>
                </div>
                <!-- box2 -->
                <div class="box">
                    <a href="#"><img src="./uploads/cars/car2.jpg" alt="car-blog"></a>
                    <h3>Porch skaine</h3>
                    <span>Année: 2017</span>
                    <p>Kilométrage: 150000 km</p>
                    <p>Carburant: Essence</p>
                    <p>Boîte de vitesse: Automatique</p>
                    <a href="#" class="blog-btn">Read More<i class='bx bx-right-arrow-alt'></i></a>
                    <span>15000€</span>
                </div>
                <!-- box3 -->
                <div class="box">
                    <a href="#"><img src="./uploads/cars/car3.jpg" alt="car-blog"></a>
                    <h3>Audi Q3</h3>
                    <span>Année 2018</span>
                    <p>Kilométrage: 188000 km</p>
                    <p>Carburant: Hibride</p>
                    <p>Boîte de vitesse: Automatique</p>
                    <a href="#" class="blog-btn">Read More<i class='bx bx-right-arrow-alt'></i></a>
                    <span>12500€</span>

                </div>
            </div>
        </section>
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

    <script src="../JS/index.js"></script>

</body>

</html>