
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./assetsAdmin/css/add_employe.css"> -->
    <title>Ajouer un Employé</title>
</head>

<body>

    <?php
    //require('../config.php');
    // require_once __DIR__ . "/../lib/config.php";
     //require_once __DIR__. "/../lib/pdo.php";
    if (isset($_REQUEST['firstname'], $_REQUEST['lastname'], $_REQUEST['email'], $_REQUEST['role'], $_REQUEST['password'])) {
        // récupérer le prenom d'utilisateur 
        $first_name = stripslashes($_REQUEST['firstname']);
        $first_name  = mysqli_real_escape_string($pdo, $first_name);
        // récupérer le nom
        $last_name = stripslashes($_REQUEST['lastname']);
        $last_name = mysqli_real_escape_string($pdo, $last_name);
        // récupérer l'email 
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($pdo, $email);
        // récupérer le mot de passe 
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($pdo, $password);
        // récupérer le type (user | admin)
        $role = stripslashes($_REQUEST['role']);
        $role = mysqli_real_escape_string($pdo, $role);

        $query = "INSERT into `users` (email, password, first_name, last_name, role)
            VALUES ('$email',  " . hash('sha256', $password) . ", '$first_name', '$last_name',  '$role')";
        $res = mysqli_query($pdo, $query);

        if ($res) {
            echo "<div class='sucess'>
                <h3>L'utilisateur a été créée avec succés.</h3>
                <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
        </div>";
        }
    } else {
    ?>

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

            <form class="box" action="" method="post">
                <h1 class="box-logo box-title">
                    <h1 class="box-title">Add user</h1>
                    <input type="text" class="box-input" name="firstname" placeholder="Prénom" required />
                    <input type="text" class="box-input" name="lastname" placeholder="Nom" required />
                    <input type="text" class="box-input" name="email" placeholder="Email" required />

                    <div>
                        <select class="box-input" name="type" id="type">
                            <option value="" disabled selected>Type</option>
                            <option value="admin">Admin</option>
                            <option value="user">Employé</option>
                        </select>
                    </div>

                    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
                    <input type="submit" name="submit" value="+ Add" class="box-button" />

            </form>
        <?php } ?>

        </main>

</body>

</html>