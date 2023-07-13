<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
//PROTECTION COMPTE ADMIN
adminOnly();


// require_once __DIR__ . "/../lib/pdo.php";
// require_once __DIR__ . "/../lib/article.php";
// require_once __DIR__ . "/templates/header.php";
//require_once __DIR__ . "/templates/header.php";

// $adminMenu = [
//     'index.php' => 'Accueil',
//     'articles.php' => 'Articles',
//     'inscription.php' => 'Inscription'
// ];
// 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assetsAdmin/css/style.css">
    <title>Admin Garage</title>
</head>
<body>
    <header>
        <div class="nav container">
            <!-- <img width="15" src="./assets/images/logo-tech-trendz.png" alt="logo-garage"> -->
            <!-- menu Icon -->
            <i class='bx bx-menu' id="menu-icon"></i>
            <!-- Logo -->
            <a href="#" class="logo">Car<span>Point</span></a>
            <!-- nav liste -->
            <ul class="navbar">
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="gestions.php">gestions</a></li>
                <li><a href="gestionServices.php">gestions services</a></li>
                <li><a href="add_employe.php">Employé</a></li>
                <li><a href="../index.php">Déconnexion</a></li>
            </ul>

            <!-- search icon -->
            <i class='bx bx-search' id="search-icon"></i>
            <!-- search box -->
            <!-- <div class="search-box container">
                <input type="search" name="" id="" placeholder="search here ...">
            </div> -->
        </div>
    </header>

    <main>
         <!-- Home section-->
         <section class="home" id="home">
            <div class="home-text">
                <h1>BIENVENUE  À LA <br>PAGE <span>ADMINISTRATION </span> DU GARAGE</h1>
            </div>
        </section>
    </main>

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
            <div class="copyright">
                <p>&#169; CarpoolVenom All Right Reserved</p>
            </div>
        </section>
    </footer>
    <!-- copyright -->
    <!-- link to js -->
    <script src="../JS/index.js"></script>

</body>
</html>