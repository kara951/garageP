<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
adminOnly();

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/service.php";


if (isset($_GET['page'])) {
  $page = (int)$_GET['page'];
} else {
  $page = 1;
}
$services = getServices($pdo, _ADMIN_ITEM_PER_PAGE_, $page);

$totalServices = getTotalServices($pdo);

$totalPages = ceil($totalServices / _ADMIN_ITEM_PER_PAGE_);


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
  <meta type="description" content="Page gestion de service admin  du garage v.parrot"/>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./assetsAdmin/css/services.css">
  <title>Page gestion services</title>
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
        <h1>Page de gestion <br> Des <span>Produits du </span> Garage V.Parrot</h1>
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

    <table class="table-style">
      <head>
        <tr>
          <th>Id</th>
          <th>Titre</th>
          <th>Modification ou Suppréssion</th>
        </tr>
      </head>
      <tbody>
        <?php foreach ($services as $service) { ?>
          <tr>
            <th scope="row"><?= $service["id"]; ?></th>
            <td><?= $service["title"]; ?></td>
            <td>
              <a href="service.php?id=<?= $service['id'] ?>">Modifier</a>
              <a href="service_delete.php?id=<?= $service['id'] ?>" onclick="
                  return confirm('Êtes-vous sûr de vouloir supprimer cet service ?')">Supprimer
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="pagination">
      <nav>
        <ul>
          <?php if ($totalPages > 1) { ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
              <li>
                <a class="page-link <?php if ($i == $page) {
                                      echo " active";
                                    } ?> " href="?page= <?php echo $i; ?> "> <?php echo $i; ?> </a>
              </li>
            <?php } ?>
          <?php } ?>
        </ul>
        <li class="ajout"><a href="service.php">Cliquer pour ajouter des produits</a></li>
      </nav>
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