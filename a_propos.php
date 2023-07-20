<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/service.php";

$error = false;
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $service = getServiceById($pdo, $id);
    if ($service["image"] === null) {
        $imagePath = _ASSETS_IMAGEPRODUIT_FOLDER_ . "assets/imageProduit/part1.png";
    } else {
        $imagePath = _SERVICES_IMAGES_FOLDER_ . $service["image"];
    }
    if (!$service) {
        $error = true;
    }
} else {
    $error = true;
}

$mainMenu = [
    'index.php' => 'Accueil',
    'services.php' => 'services',
    'actualites.php' => 'vehicules',
    'login.php' => 'se connecter',
    'logout.php' => 'Déconnexion'
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta type="description" content="Page vehicules du garage v.parrot"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/a_propos.css">
    <title>A propos</title>
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
                <?php foreach ($mainMenu as $page => $titre) { ?>
                    <li>
                        <a href="<?= $page; ?>" <?php if (basename($_SERVER['SCRIPT_NAME']) === $page) {
                                                    echo 'active';
                                                } ?>>
                            <?= $titre; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <div>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="logout.php">Déconnexion</a>
                <?php } else { ?>
                    <!-- <a href="login.php">Login</a> -->
                    <!-- <a href="inscription.php" >Inscription</a> -->
                <?php } ?>
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
                <h1>We Have everything <br> Your <span>Car</span> Need</h1>
                <p>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Corporis,
                    dolorum quaerat iste aperiam quia
                </p>
                <!-- home button -->
                <a href="#" class="btn">Discover Now</a>
            </div>
        </section>

        <!-- About  -->
        <?php if (!$error) { ?>
            <section class="about container" id="about">
                <div class="about-img">
                    <!-- attention image est en dur -->
                    <!-- <img src="uploads/services/part2.png" alt="about"> -->
                    <img src="uploads/services/<?= $service["image"] ?>" alt="service....">
                </div>

                <div class="about-text">
                    <span>Abour Us</span>
                    <!-- <h2>Cheap Prices With <br> Quality Cars</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, enim!</p>  -->

                    <h2><?= htmlentities($service["title"]) ?></h2>
                    <p><?= htmlentities($service["content"]) ?></p>
                    <span><?= htmlentities($service["prix"]) ?></span>
                    <li><a href="contact.php">Contactez-nous</a></li>
                </div>

            </section>
        <?php } else { ?>
            <h2>Service introuvable...</h2>
        <?php } ?>
    </main>

    <footer>
        <section class="footer">
            <div class="footer-container container">
                <div class="footer-box">
                    <a href="#" class="logo">Garage<span>Perrot</span></a>
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
                    <li><a href="services.php">services</a></li>
                    <li><a href="actualites.php">vehicules</a></li>
                    <li><a href="login.php">se connecter</a></li>
                    <li><a href="contact.php">Contactez-nous</a></li>
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
                    <p>Dimanche :  Fermer</p>
                </div>
            </div>
        </section>
    </footer>
    <!-- copyright -->
    <div class="copyright">
        <p>&#169;2023</p>
    </div>

    <script src="front/js/index.js"></script>

</body>

</html>