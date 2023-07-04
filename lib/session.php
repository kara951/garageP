<?php

// PARAMETRE DE SECUIRITÉ
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    //ATTENTION ON NE PEUT PAS SE CONNECTER À ADMIN AVEC LE NOM DE DOMAINE EN LOCALE, SEULEMENT UN VRAI NOM DE DOMAIN.
    // 'domain' => _DOMAIN_,

    // quant on crée de cookie en php par default on va pouvoir accéder en js, 
    // si quelqu'un pirate le cookie en js avec httponly il ne pour pas acces au cookie php.
    'httponly' => true
]);

session_start();

// PROTECTION COMPTE ADMIN
// CETTE PAGE VERIFIE L'IDENTITÉ DE USER
function adminOnly()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
        // Rediriger vers la page de connexion
        header("Location: ../login.php");
        exit();
    }
}
