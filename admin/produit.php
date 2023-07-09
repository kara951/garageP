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
$produit = [
    'title' => '',
    'content' => '',
    'category_id' => ''
];

$categories = getCategories($pdo);

if (isset($_GET['id'])) {
    //requête pour récupérer les données de produits en cas de modification
    $produit = getCarById($pdo, $_GET['id']);
    if ($produit === false) {
        $errors[] = "L'article n\'existe pas";
    }
    //$pageTitle = "Formulaire modification article";
} else {
      $pageTitle = "Formulaire ajout article";
}

// on test si le formulaire a bien été envoyé avec saveArticle qui le button recupéré en bas 
if (isset($_POST['saveArticle'])) {

    //@todo gérer la gestion des erreurs sur les champs (champ vide etc.)

    $fileName = null;
    // Si un fichier est envoyé
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {

        // getimagesize elle verifie si c'est une image elle telecharge si c'st autre chose elle ne peut pas
        // BEUG................
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            // uniqid id unique du fichier
            $fileName = uniqid() . '-' . $fileName;



            /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__) 
                permet de cibler le dossier parent car on se trouve dans admin
            */
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ . $_POST['image']);
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
                unlink(dirname(__DIR__) . _ARTICLES_IMAGES_FOLDER_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }
    /* On stocke toutes les données envoyés dans un tableau pour pouvoir afficher
       les informations dans les champs. C'est utile pas exemple si on upload un mauvais
       fichier et qu'on ne souhaite pas perdre les données qu'on avait saisit.
    */
    $produit= [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
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
        $res = saveCar($pdo, $_POST["title"], $_POST["content"], $fileName, (int)$_POST["category_id"], $id);

        if ($res) {
            $messages[] = "L'article a bien été sauvegardé";
            //On vide le tableau article pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $produit = [
                    'title' => '',
                    'content' => '',
                    'category_id' => ''
                ];
            }
        } else {
            $errors[] = "L'article n'a pas été sauvegardé";
        }
    }
}

?>
<h1><?= $pageTitle; ?></h1>

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
<?php if ($produit !== false) { ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assetsAdmin/css/produit.css">
    <title>Page d'article</title>
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
                <li><a href="gestions.php">gestions</a></li>
                <!-- <li><a href="produit.php">Ajouté_produits</a></li> -->
                <li><a href="add_employe.php">Employé</a></li>
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
                <h1>Formulaire D'ajouter<br>Du <span>Contenu au </span>Site</h1>
            </div>
        </section>

        <div class="container-form">
            <form method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="title">Titre</label>
                    <div class="icon-input-container">
                        <input type="text" autocomplete="off" id="title" name="title" placeholder="Titre" value="<?= $produit['title']; ?>">
                    </div>
                </div>

                <div class="input-group">
                    <label for="content">Contenu</label>
                    <div class="icon-input-container">
                        <textarea name="content" id="content" cols="67" rows="5" placeholder="Contenu"><?= $produit['content']; ?></textarea>
                    </div>
                </div>

                <div>
                    <label for="category">Catégorie</label>
                    <!--  class="form-select" -->
                    <select name="category_id" id="category">
                        <?php foreach ($categories as $category) { ?>
                            <option value="1" <?php if (
                                                        isset($produit['category_id']) &&
                                                        $produit['category_id'] == $category['id']
                                                    ) { ?>selected="selected" <?php }; ?>><?= $category['name'] ?>
                            </option>
                            <?php } ?>
                    </select>
                </div>

                <?php if (isset($_GET['id']) && isset($produit['image'])) { ?>
                    <p>
                        <img src="<?= _ARTICLES_IMAGES_FOLDER_ . $produit['image'] ?>" alt="<?= $produit['title'] ?>" width="100">
                        <label for="delete_image">Supprimer l'image</label>
                        <input type="checkbox" name="delete_image" id="delete_image">
                        <input type="hidden" name="image" value="<?= $produit['image']; ?>">
                    </p>
                <?php } ?>

                <p><input type="file" name="file" id="file"></p>

                <!-- <input type="submit" name="saveArticle" class="btn btn-primary" value="Enregistrer"> -->
                 <button type="submit" name="saveArticle">save</button>
            </form>
        </div>
        <?php } ?>
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
    </body>

    </html>