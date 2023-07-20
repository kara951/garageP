<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
//PROTECTION COMPTE ADMIN
adminOnly();


$adminMenu = [
    'index.php' => 'Accueil',
    'gestions.php' => 'gestions',
    'gestionServices.php' => 'gestions services',
    '../inscription.php' => 'Inscription',
    '../logout.php' => 'Déconnexion'
];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta type="description" content="Page accueil admin  du garage v.parrot"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assetsAdmin/css/style.css">
    <title>Admin Garage</title>
</head>

<body>

    <header>
        <div class="nav container">
            <!-- menu Icon -->
            <i class='bx bx-menu' id="menu-icon"></i>
            <!-- Logo -->
            <a href="#" class="logo">Garage V.<span>Parrot</span></a>

            <!-- nav liste -->
            <ul class="navbar">
                <ul class="navbar">
                    <?php foreach ($adminMenu as $page => $titre) { ?>
                        <li>
                            <a href="<?= $page; ?>" <?php if (basename($_SERVER['SCRIPT_NAME']) === $page) {
                                                        echo 'active';
                                                    } ?>>
                                <?= $titre; ?>
                            </a>
                        </li>
                    <?php } ?>

                    <!-- <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="gestions.php">gestions</a></li>
                <li><a href="gestionServices.php">gestions services</a></li> -->

                    <!-- :::: <li><a href="service.php">Service</a></li> :::::::-->

                    <!-- <li><a href="inscription.php">Employé</a></li>
                <li><a href="../index.php">Déconnexion</a></li> -->
                </ul>

                <div>
                    <a href="#" class="">
                        <strong><?= $_SESSION["user"]["first_name"]; ?></strong>
                    </a>
                </div>

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
                <h1>BIENVENUE À LA <br>PAGE <span>ADMINISTRATION </span> Garage V.Parrot</h1>
            </div>
        </section>
    </main>

    <footer>
        <section class="footer">
            <div class="footer-container container">
                <div class="footer-box">
                    <a href="#" class="logo">Garage V.<span>Parrot</span></a>
                    <div class="social">
                        <a href="#"><i class='bx bxl-facebook'></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                        <a href="#"><i class='bx bxl-instagram'></i></a>
                        <a href="#"><i class='bx bxl-youtube'></i></a>
                    </div>
                </div>
                <div class="footer-box">
                    <h3>Page</h3>
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li><a href="gestions.php">gestions</a></li>
                    <li><a href="gestionServices.php">gestions services</a></li>
                    <li><a href="service.php">Service</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                </div>
                <div class="footer-box">
                    <h3>Informations utiles</h3>
                    <a href="#"><i class='bx bx-envelope'></i> garage.vparrot@gmail.com</a>
                    <a href="#"> <i class='bx bxs-phone'></i> 0561718191</a>
                    <a href="#"> <i class='bx bxs-map'></i> 1 Rue Perigord</a>
                </div>
                <div class="footer-box">
                    <h3>Horaires d'ouvertures</h3>
                    <p>Lundi : 8h45-12h00 14h00-18h00</p>
                    <p>Mardi : 8h45-12h00 14h00-18h00</p>
                    <p>Mercredi : 8h45-12h00 14h00-18h00</p>
                    <p>Jeudi : 8h45-12h00 14h00-18h00</p>
                    <p>Vendredi : 8h45-12h00 14h00-18h00</p>
                    <p>Samedi : 8h45-12h00 Fermer</p>
                    <p>Dimanche : Fermer</p>
                </div>
            </div>
        </section>
    </footer>
    <!-- copyright -->
    <div class="copyright">
        <p>&#169;2023</p>
    </div>
    <!-- link to js -->
    <script src="frontAdmin/js/index.js"></script>

</body>

</html>