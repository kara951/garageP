<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

// PROTECTION COMPTE ADMIN
adminOnly();

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/car.php";
require_once __DIR__ . "/../lib/category.php";


$errors = [];
$messages = [];
$car = [
    'title' => '',
    'content' => '',
    'modele' => '',
    'annee' => '',
    'kilometre' => '',
    'vitesse' => '',
    'carburant' => '',
    'prix' => '',
    'category_id' => ''
];

$categories = getCategories($pdo);

if (isset($_GET['id'])) {
    //requête pour récupérer les données de car en cas de modification
    $car = getCarById($pdo, $_GET['id']);
    if ($car === false) {
        $errors[] = "Véhicule n\'existe pas";
    }
    $pageTitle = "Formulaire modification car";
} else {
    $pageTitle = "Formulaire ajout véhicule";
}

// on test si le formulaire a bien été envoyé avec saveCar qui le button recupéré en bas 
if (isset($_POST['saveCar'])) {

    //@todo gérer la gestion des erreurs sur les champs (champ vide etc.)

    $fileName = null;
    // Si un fichier est envoyé
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {

        // getimagesize elle verifie si c'est une image elle telecharge si c'est autre chose elle ne peut pas
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            // uniqid id unique du fichier
            $fileName = uniqid() . '-' . $fileName;



            /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__) 
                permet de cibler le dossier parent car on se trouve dans admin
            */
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _CARS_IMAGES_FOLDER_  . $fileName)) {
                if (isset($_POST['image'])) {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__) . _CARS_IMAGES_FOLDER_  . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {
        // Si aucun fichier n'a été envoyé
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                // Si on a coché la case de suppression d'image, on supprime l'image
                unlink(dirname(__DIR__) . _CARS_IMAGES_FOLDER_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }
    /* On stocke toutes les données envoyés dans un tableau pour pouvoir afficher
       les informations dans les champs. C'est utile par exemple si on upload un mauvais
       fichier et qu'on ne souhaite pas perdre les données qu'on avait saisit.
    */
    $car = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'modele'  => $_POST['modele'],
        'annee' => $_POST['annee'],
        'kilometre' => $_POST['kilometre'],
        'vitesse' => $_POST['vitesse'],
        'carburant' => $_POST['carburant'],
        'prix' => $_POST['prix'],
        'category_id' => $_POST['category_id'],
        'image' => $fileName
    ];
    // Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            // Avec (int) on s'assure que la valeur stockée sera de type int
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }
        // On passe toutes les données à la fonction saveCar
        $res = saveCar($pdo, $_POST["title"], $_POST["content"], $_POST["modele"], $_POST['annee'], $_POST['kilometre'], $_POST['vitesse'], $_POST['carburant'], $_POST['prix'],  $fileName, (int)$_POST["category_id"], $id);

        if ($res) {
            $messages[] = "Véhicule a bien été sauvegardé";
            //On vide le tableau car pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $car = [
                    'title' => '',
                    'content' => '',
                    'modele' => '',
                    'annee' => '',
                    'kilometre' => '',
                    'vitesse' => '',
                    'carburant' => '',
                    'prix' => '',
                    'category_id' => ''
                ];
            }
        } else {
            $errors[] = "Véhicule n'a pas été sauvegardé";
        }
    }
}

$adminMenu = [
    'index.php' => 'Accueil',
    'gestions.php' => 'gestions',
    'gestionServices.php' => 'gestions services',
    'inscription.php' => 'Inscription',
    '../logout.php' => 'Déconnexion'
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta type="description" content="Page vehicule admin  du garage v.parrot"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assetsAdmin/css/car.css">
    <title>Page véhicule</title>
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
                <h1>Formulaire D'ajouter<br>Du <span>Contenu</span> Garage V.Parrot</h1>
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
            <?php if ($car !== false) { ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <label for="title">Marque</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="title" name="title" placeholder="Marque" value="<?= $car['title']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="modele">Modéle</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="modele" name="modele" placeholder="Modèle" value="<?= $car['modele']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="annee">Année</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="annee" name="annee" placeholder="Année" value="<?= $car['annee']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="kilometre">Kilométrage</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="kilometre" name="kilometre" placeholder="Kilomètre" value="<?= $car['kilometre']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="vitesse">Boîte de vitesse</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="vitesse" name="vitesse" placeholder="Boîte de vitesse" value="<?= $car['vitesse']; ?>">
                        </div>
                    </div>


                    <div class="input-group">
                        <label for="carburant">Énergie</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="carburant" name="carburant" placeholder="Énergie" value="<?= $car['carburant']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="prix">Prix</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="prix" name="prix" placeholder="Prix" value="<?= $car['prix']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="content">Contenu</label>
                        <div class="icon-input-container">
                            <textarea name="content" id="content" cols="67" rows="5" placeholder="Contenu"><?= $car['content']; ?></textarea>
                        </div>
                    </div>

                    <div>
                        <label for="category">Catégorie</label>
                        <!--  class="form-select" -->
                        <select name="category_id" id="category">
                            <?php foreach ($categories as $category) { ?>
                                <option value="1" <?php if (isset($car['category_id']) && $car['category_id'] == $category['id']) { ?>selected="selected" <?php }; ?>><?= $category['name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php if (isset($_GET['id']) && isset($car['image'])) { ?>
                        <p>
                            <img src="<?= _CARS_IMAGES_FOLDER_ . $car['image'] ?>" alt="<?= $car['title'] ?>" width="100">
                            <label for="delete_image">Supprimer l'image</label>
                            <input type="checkbox" name="delete_image" id="delete_image">
                            <input type="hidden" name="image" value="<?= $car['image']; ?>">
                        </p>
                    <?php } ?>

                    <p><input type="file" name="file" id="file"></p>

                    <!-- <input type="submit" name="saveCar" class="btn btn-primary" value="Enregistrer"> -->
                    <button type="submit" name="saveCar">Enrégistré</button>
                </form>
        </div>
    <?php } ?>
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
    <script src="frontAdmin/js/index.js"></script>
</body>

</html>