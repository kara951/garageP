<?php

// $cars = [
//     ["title" => "Clio 3", "annee" => "Année: 2014", "kilometre" => "Kilométrage: 150000 km", "carburant" => "Diesel", "boiteV" => "Manuelle", "prix" => "Prix: 2500€", "image" => "car1.jpg"],
//     ["title" => "Porch skaine", "annee" => "Année: 2022", "kilometre" => "Kilométrage: 110000 km", "carburant" => "Hybride", "boiteV" => "Automation", "prix" => "Prix: 45000€", "image" => "car2.jpg"],
//     ["title" => "Golf 6", "annee" => "Année: 2012", "kilometre" => "Kilométrage: 128000 km", "carburant" => "Hybride", "boiteV" => "Manuelle", "prix" => "Prix: 8000€","image" => "car3.jpg"],
//     ["title" => "Audi A3", "annee" => "Année: 2009", "kilometre" => "Kilométrage: 141000 km", "carburant" => "Essence", "boiteV" => "Manuelle", "prix" => "Prix: 7000€", "image" => "car4.jpg"],
//     ["title" => "Toyota", "annee" => "Année: 2011", "kilometre" => "Kilométrage: 158000 km", "carburant" => "Electrique", "boiteV" => "Automatique", "prix" => "Prix: 5000€", "image" => "car5.jpg"],
//     ["title" => "Bmw serie B", "annee" => "Année: 2019", "kilometre" => "Kilométrage: 1880000 km", "carburant" => "Electricque", "boiteV" => "Automatique", "prix" => "Prix: 25500€", "image" => "car6.jpg"],
// ];

// function getCarById(array $cars, int $id)
// {
//     if (isset($cars[$id])) {
//         return $cars[$id];
//     } else {
//         return false;
//     }
// }

// function getServiceById(PDO $pdo, int $id){
//     $query = $pdo->prepare("SELECT * FROM car WHERE id = :id");
//     $query->bindValue(":id", $id, PDO::PARAM_INT);
//     $query->execute();
//     return $query->fetch(PDO::FETCH_ASSOC);
// }


//===========================================================================================================>
function getCarById(PDO $pdo, int $id): array|bool // getCarById
{
    $query = $pdo->prepare("SELECT * FROM car WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Function de recuperation de données.
// int $limit =null on donne valeur par defautl, si on affiche que 3 car dans la page d'accueil et 20 dans actualité
// donc c'est comme ça qu'il faudra faire
function getCars(PDO $pdo, int $limit = null, $page = null): array|bool
{

    $sql = "SELECT * FROM car ORDER BY id DESC"; //ORDER BY id DESC  => pour afficher les derniers car.

    if ($limit && !$page) {
        $sql .= " LIMIT :limit"; // une façons d'écrire une variable
    }
    if ($limit && $page) {
        $sql .= " LIMIT :offest, :limit";
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
    }
    if ($page) {
        $offset = ($page - 1) * $limit;
        $query->bindValue(":offest", $offset, PDO::PARAM_INT);
    }
    // $query =$pdo->prepare("SELECT * FROM car");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalCars(PDO $pdo): int|bool
{
    $sql = "SELECT COUNT(*) as total FROM car";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function saveCar(PDO $pdo, string $title, string $content, string $modele, string $annee, string $kilometre, string $vitesse, string $color, string $place, string $porte, string $puissance, string $carburant, string $prix, string|null $image, int $category_id, int $id = null): bool
{
    if ($id === null) {
        // si id est null requete insert
        $query = $pdo->prepare("INSERT INTO car (title, content, modele, annee, kilometre, vitesse, color, place, porte, puissance, carburant, prix, image, category_id) "
            . "VALUES(:title, :content, :modele, :annee, :kilometre, :vitesse, :color, :place, :porte, :puissance, :carburant, :prix, :image, :category_id)");
    } else {
        // si on passe un id on fait une update
        $query = $pdo->prepare("UPDATE `car` SET `title` = :title, "
            . "`content` = :content, "
            . "modele = :modele, "
            . "annee = :annee, "
            . "kilometre =:kilometre, "
            . "vitesse =:vitesse, "
            . "color =:color, "
            . "place =:place, "
            . "porte =:porte, "
            . "puissance =:puissance, "
            . "carburant =:carburant, "
            . "prix =:prix, "
            . "image = :image, category_id = :category_id WHERE `id` = :id;");

        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':title', $title, $pdo::PARAM_STR);
    $query->bindValue(':content', $content, $pdo::PARAM_STR);
    $query->bindValue('modele', $modele, $pdo::PARAM_STR);
    $query->bindValue('annee', $annee, $pdo::PARAM_STR);
    $query->bindValue('kilometre', $kilometre, $pdo::PARAM_STR);
    $query->bindValue('vitesse', $vitesse, $pdo::PARAM_STR);
    $query->bindValue('color', $color, $pdo::PARAM_STR);
    $query->bindValue('place', $place, $pdo::PARAM_STR);
    $query->bindValue('porte', $porte, $pdo::PARAM_STR);
    $query->bindValue('puissance', $puissance, $pdo::PARAM_STR);
    $query->bindValue('carburant', $carburant, $pdo::PARAM_STR);
    $query->bindValue('prix', $prix, $pdo::PARAM_STR);
    $query->bindValue(':image', $image, $pdo::PARAM_STR);
    $query->bindValue(':category_id', $category_id, $pdo::PARAM_INT);
    return $query->execute();
}

function deleteCar(PDO $pdo, int $id): bool
{

    $query = $pdo->prepare("DELETE FROM car WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
