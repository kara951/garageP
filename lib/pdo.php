<?php
try {
    // $pdo = new PDO("mysql:dbname=studi_techtrendz;host=localhost;charset=utf8mb4", "root", "");
    $pdo = new PDO("mysql:dbname=" . _DB_NAME_ . ";localhost;charset=utf8mb4", _DB_USER_, _DB_PASSWORD_);
    //studi_techtrendz
} catch (Exception $e) {
    die("Erreur :" . $e->getMessage());
}
