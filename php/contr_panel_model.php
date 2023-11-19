<?php

require_once "connection.php";

function add_genre(object $pdo, string $genre)
{
    $query = "INSERT INTO genres (name) VALUES (:name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $genre);
    $stmt->execute();
}