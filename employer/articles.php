<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
adminOnly();

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/article.php";
require_once __DIR__ . "/templates/header.php";

if (isset($_GET['page'])) {
  $page = (int)$_GET['page'];
} else {
  $page = 1;
}
$articles = getCars($pdo, _ADMIN_ITEM_PER_PAGE_, $page);

$totalArticles = getTotalArticles($pdo);

$totalPages = ceil($totalArticles / _ADMIN_ITEM_PER_PAGE_);

?>
<!-- ============================================================================================= -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assetsAdmin/css/articles.css">
  <title>Page d'articles</title>
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
          <li><a href="article.php">Ajouter</a></li>
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
          <h1>Page de gestion <br> Des <span>Produits du </span> Site</h1>
        </div>
      </section>

      <!-- <div><a href="article.php">Ajouter un article</a></div> -->

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
          <?php foreach ($articles as $article) { ?>
            <tr>
            <th scope="row"><?= $article["id"]; ?></th>
            <td><?= $article["title"]; ?></td>
            <td>
              <a href="article.php?id=<?= $article['id'] ?>">Modifier</a>
              <a href="article_delete.php?id=<?= $article['id'] ?>" onclick="
                  return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer
              </a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      
        <div  class="pagination">
          <nav >
            <ul>
              <?php if ($totalPages > 1) { ?> 
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                  <li>
                    <a class="page-link <?php if ($i == $page){echo " active";}?> " href="?page= <?php echo $i; ?> "> <?php echo $i; ?> </a>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
            </nav>
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
    <!-- link to js -->
</body>
</html>
