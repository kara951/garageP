<?php

function getServiceById(PDO $pdo, int $id): array|bool
{
    $query = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getServices(PDO $pdo, int $limit = null, int $page = null): array|bool
{
    $sql = "SELECT * FROM services ORDER BY id DESC";

    if ($limit && !$page) {
        $sql .= " LIMIT  :limit";
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

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalServices(PDO $pdo): int|bool
{
    $sql = "SELECT COUNT(*) as total FROM services";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function saveService(PDO $pdo, string $title, string $content, string $price, string $star, string|null $image, int $category_id, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO services (title, content, prix, star,image, category_id) "
            . "VALUES(:title, :content, :prix, :star, :image, :category_id)");
    } else {
        $query = $pdo->prepare("UPDATE `services` SET `title` = :title, "
            . "`content` = :content, "
            . "`prix` = :prix, "
            . "`star` = :star, "
            . "image = :image, category_id = :category_id WHERE `id` = :id;");

        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':title', $title, $pdo::PARAM_STR);
    $query->bindValue(':content', $content, $pdo::PARAM_STR);
    $query->bindValue(':prix', $price, $pdo::PARAM_STR);
    $query->bindValue(':star', $star, $pdo::PARAM_STR);
    $query->bindValue(':image', $image, $pdo::PARAM_STR);
    $query->bindValue(':category_id', $category_id, $pdo::PARAM_INT);
    return $query->execute();
}

function deleteService(PDO $pdo, int $id): bool
{

    $query = $pdo->prepare("DELETE FROM services WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
