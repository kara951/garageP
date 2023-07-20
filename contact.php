<?php
require_once __DIR__ . "/lib/car.php";

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
    <meta type="description" content="Page contact du garage v.parrot"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/contact.css">
    <title>Page contact</title>
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
        <h1 class="contact">Contactez-nous</h1>
        <!-- Home section-->
        <section class="home" id="home">
            <div class="home-text">
                <!-- <h1>Prenez contact avec <br> nos experts <span>Ils sont </span> votre service</h1>
                <h1>Contactez-nous</h1> -->
            </div>


        </section>

        <div class="container-form">
            <form action="" method="post">
                <div class="input-group">
                    <label for="name">Nom :</label>
                    <div class="icon-input-container">
                        <input type="text" autocomplete="off" id="name" name="name" placeholder="nom">
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">E-mail :</label>
                    <div class="icon-input-container">
                        <input type="text" autocomplete="off" id="email" name="email" placeholder="email">
                    </div>
                </div>

                <div class="input-group">
                    <label for="sujet">Sujet :</label>
                    <div class="icon-input-container">
                        <input type="text" autocomplete="off" id="sujet" name="sujet" placeholder="sujet">
                    </div>
                </div>

                <div class="input-group">
                    <label for="textarea">Contactez-nous</label>
                    <div class="icon-input-container">
                        <textarea autocomplete="off" id="textarea" name="textarea" cols="67" rows="10" placeholder="Votre message"></textarea>
                    </div>
                </div>

                <button type="submit">Envoyer</button>
            </form>
        </div>
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
                    <p>Dimanche : Fermer</p>
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