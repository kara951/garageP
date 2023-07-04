<?php

// require_once 'lib/config.php'1;
// // require_once 'lib/tools.php' 1;
// // require_once 'lib/pdo.php'  1;
// // require_once 'lib/user.php';

// // require_once 'templates/header.php';1


// require_once __DIR__ . "/../lib/config.php"; //1
// require_once __DIR__ . "/../lib/session.php";

// // PROTECTION COMPTE ADMIN
// adminOnly();

// require_once __DIR__ . "/../lib/pdo.php"; //1
// require_once __DIR__ . "/../lib/tools.php"; //1
// require_once __DIR__ . "/../lib/article.php";
// require_once __DIR__ . "/../lib/category.php";

// //require_once __DIR__ . "/templates/header.php";



// $errors = [];
// $messages = [];
// if (isset($_POST['addEmploye'])) {
//     /*
//         @todo ajouter la vérification sur les champs
//     */
//     $res = addEmploye($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
//     if ($res) {
//         $messages[] = 'Merci pour votre inscription';
//     } else {
//         $errors[] = 'Une erreur s\'est produite lors de votre inscription';
//     }
// }

// 
?>

<!-- <h1>Page d'inscription d'employé</h1>
<a class="btn btn-primary d-inline-flex align-items-left" href="addEmploye.php">

    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?> -->








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assetsAdmin/css/inscription.css">
    <title>Page d'inscription</title>
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
                <li><a href="articles.php">Articles</a></li>
                <li><a href="article.php">Article</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="../index.php">Déconnexion</a></li>
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
</body>
</html>





















<!-- <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription d'employeé</title>
    </head>
    <body>
    <form method="POST">
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de psse</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <input type="submit" name="addEmploye" class="btn btn-primary" value="Enregistrer">

    </form>
    </body>
    </html> -->