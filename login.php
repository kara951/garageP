<?php
require_once 'lib/config.php';
require_once 'lib/session.php';
require_once 'lib/pdo.php';
require_once 'lib/user.php';



$errors = [];
$messages = [];

if (isset($_POST['loginUser'])) {

    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user) {
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        if ($user['role'] === 'admin') {
            // beug
            header('location: admin/index.php');
        } else {
            header('location: index.php');
        }
    } else {
        $errors[] = 'Email ou mot de passe incorrect';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>A propos</title>
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
                <li><a href="actualites.php">Actualités</a></li>
                <li><a href="a_propos.php">A Propos</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="inscription.php">Inscription</a></li>
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
                <p>Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Corporis,
                    dolorum quaerat iste aperiam quia
                </p>
                <!-- home button -->
                <a href="#" class="btn">Discover Now</a>
            </div>
        </section>

        <?php foreach ($messages as $message) { ?>
            <div class="alert alert-success" role="alert">
                <?= $message; ?>
            </div>
        <?php } ?>
        <?php foreach ($errors as $error) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error; ?>
            </div>
        <?php } ?>

        <div class="container-form">
            <form action="" method="post">
                <div class="input-group">
                    <label for="email">Entrez votre email</label>
                    <div class="icon-input-container">
                        <input type="text"autocomplete="off"id="email" name="email" placeholder="Votre email">
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <div class="icon-input-container">
                        <input type="password"autocomplete="off"id="password" name="password" placeholder="Votre mot de passe">
                    </div>
                </div>

                <button type="submit" name="loginUser">Je me connecte</button>
                <p>Vous êtes nouveau ici ? <a href="inscription.php"> S'inscrire</a></p>
            </form>
        </div>
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
        </section>
    </footer>
    <!-- copyright -->
    <div class="copyright">
        <p>&#169; CarpoolVenom All Right Reserved</p>
    </div>

    <script src="../JS/index.js"></script>

</body>

</html>