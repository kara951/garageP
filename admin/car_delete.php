<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

// PROTECTION COMPTE ADMIN
adminOnly();

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/car.php";
//require_once __DIR__ . "/templates/header.php";

$car = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $car =  getCarById($pdo, $_GET["id"]);
}
if ($car) {
    if (deleteCar($pdo, $_GET["id"])) {
        $messages[] = "Le Produit a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le produit n'existe pas";
}

?>
<div class="">
    <h1>Supression du produit</h1>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
        <div class="" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>
</div>

<?php
//require_once('templates/footer.php');
