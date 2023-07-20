<?php
require_once 'lib/config.php';
require_once 'lib/tools.php';
require_once 'lib/pdo.php';
require_once 'lib/user.php';

$errors = [];
$messages = [];
if (isset($_POST['addUser'])) {
    /*
                @todo ajouter la vérification sur les champs
            */
    $res = addUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
    if ($res) {
        $messages[] = 'Merci pour votre inscription';
    } else {
        $errors[] = 'Une erreur s\'est produite lors de votre inscription';
    }
}

$mainMenu = [
    'index.php' => 'Accueil',
    'services.php' => 'services',
    'actualites.php' => 'vehicules',
    'login.php' => 'se connecter',
    'logout.php' => 'Déconnexion',
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta type="description" content="Page inscription du garage v.parrot"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/inscription.css">
    <title>Page d'inscription</title>
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

                <!-- <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="services.php">Nos services</a></li>
                <li><a href="actualites.php">Nos vehicules</a></li> -->

                <!-- <li><a href="a_propos.php">A Propos</a></li> -->

                <!-- <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">se connecter</a></li>
                <li><a href="../index.php">Déconnexion</a></li> -->

                <!-- <li><a href="inscription.php">Inscription</a></li> -->
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
            </div>
        </section>

        <div class="container-form">

            <?php foreach ($messages as $message) { ?>
                <div class="message" style="color:green" role="alert">
                    <?= $message; ?>
                </div>
            <?php } ?>

            <?php foreach ($errors as $error) { ?>
                <div class="error" style="color: red;" role="alert">
                    <?= $error; ?>
                </div>
            <?php } ?>

            <h2>Inscrivez-vous.</h2>
            <form method="POST">
                <div class="input-group">
                    <label for="first_name">Prénom</label>
                    <div class="icon-input-container">
                        <input type="text" autocomplete="off" id="first_name" name="first_name" placeholder="3 caractères minimum" maxlength="24">
                        <img src="ressources/check.svg" alt="icone de validation" class="icone-verif">
                    </div>
                    <span class="error-msg">Choisissez un pseudo contenant au moins 3 caractères.</span>
                </div>

                <div class="input-group">
                    <label for="last_name">Nom</label>
                    <div class="icon-input-container">
                        <input type="text" autocomplete="off" id="last_name" name="last_name" placeholder="3 caractères minimum" maxlength="24">
                        <img src="ressources/check.svg" alt="icone de validation" class="icone-verif">
                    </div>
                    <span class="error-msg">Choisissez un pseudo contenant au moins 3 caractères.</span>
                </div>

                <div class="input-group">
                    <label for="email">Entrez votre email</label>
                    <div class="icon-input-container">
                        <input type="text" autocomplete="off" id="email" name="email" placeholder="Votre email">
                        <img src="ressources/check.svg" alt="icone de validation" class="icone-verif">
                    </div>
                    <span class="error-msg">Rentrez un email valide.</span>
                </div>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <div class="icon-input-container">
                        <input type="password" autocomplete="off" id="password" name="password" placeholder="Votre mot de passe">
                        <img src="ressources/check.svg" alt="icone de validation" class="icone-verif">
                    </div>
                    <span class="pswd-info">Au moins un symbole, un chiffre, ainsi que 6 caractères minimum.</span>
                    <div class="lines">
                        <div class="l1"><span>faible</span></div>
                        <div class="l2"><span>moyen</span></div>
                        <div class="l3"><span>fort</span></div>
                    </div>
                </div>

                <div class="input-group">
                    <label for="psw-confirmation">Confirmez le mot de passe</label>
                    <div class="icon-input-container">
                        <input type="password" autocomplete="off" id="psw-confirmation" placeholder="Confirmez le mot de passe">
                        <img src="ressources/check.svg" alt="icone de validation" class="icone-verif">
                    </div>
                </div>

                <button type="submit" name="addUser">S'inscrire</button>
                <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
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
    <div class="copyright">
        <p>&#169;2023</p>
    </div>
    <script src="front/js/index.js"></script>
</body>

</html>