<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

// PROTECTION COMPTE ADMIN
adminOnly();

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/service.php";
require_once __DIR__ . "/../lib/category.php";


$errors = [];
$messages = [];
$service = [
    'title' => '',
    'content' => '',
    'category_id' => ''
];

$categories = getCategories($pdo);

if (isset($_GET['id'])) {
    $service = getServiceById($pdo, $_GET['id']);
    if ($service === false) {
        $errors[] = "Service n\'existe pas";
    }
    $pageTitle = "Formulaire modification service";
} else {
}

if (isset($_POST['saveService'])) {

    $fileName = null;

    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {

        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);

        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _SERVICES_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {

                    unlink(dirname(__DIR__) . _SERVICES_IMAGES_FOLDER_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {

        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                unlink(dirname(__DIR__) . _SERVICES_IMAGES_FOLDER_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }

    $service = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'image' => $fileName
    ];

    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveService($pdo, $_POST["title"], $_POST["content"], $_POST["prix"], $_POST["star"], $fileName, (int)$_POST["category_id"], $id);

        if ($res) {
            $messages[] = "Service a bien été sauvegardé";

            if (!isset($_GET["id"])) {
                $service = [
                    'title' => '',
                    'content' => '',
                    'category_id' => ''
                ];
            }
        } else {
            $errors[] = "Service n'a pas été sauvegardé";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta type="description" content="Page admin service du garage v.parrot" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assetsAdmin/css/service.css">
    <title>Page de service</title>
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

            <?php if ($service !== false) { ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <label for="title">Titre</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="title" name="title" placeholder="Titre" value="<?= $service['title']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="prix">Prix</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="prix" name="prix" placeholder="Prix" value="<?= $services['prix']; ?>">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="star">Etoile</label>
                        <div class="icon-input-container">
                            <input type="text" autocomplete="off" id="star" name="star" placeholder="star" value="<?= $car['star']; ?>">
                        </div>
                    </div>


                    <div class="input-group">
                        <label for="content">Contenu</label>
                        <div class="icon-input-container">
                            <textarea name="content" id="content" cols="67" rows="5" placeholder="Contenu"><?= $service['content']; ?></textarea>
                        </div>
                    </div>

                    <div>
                        <label for="category">Catégorie</label>
                        <!--  class="form-select" -->
                        <select name="category_id" id="category">
                            <?php foreach ($categories as $category) { ?>
                                <option value="1" <?php if (
                                                        isset($service['category_id']) &&
                                                        $service['category_id'] == $category['id']
                                                    ) { ?>selected="selected" <?php }; ?>><?= $category['name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php if (isset($_GET['id']) && isset($service['image'])) { ?>
                        <p>
                            <img src="<?= _SERVICES_IMAGES_FOLDER_ . $service['image'] ?>" alt="<?= $service['title'] ?>" width="100">
                            <label for="delete_image">Supprimer l'image</label>
                            <input type="checkbox" name="delete_image" id="delete_image">
                            <input type="hidden" name="image" value="<?= $service['image']; ?>">
                        </p>
                    <?php } ?>

                    <p><input type="file" name="file" id="file"></p>

                    <button type="submit" name="saveService">Enrégistré</button>
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