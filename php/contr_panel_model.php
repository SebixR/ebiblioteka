<?php

require_once "connection.php";

function add_genre(object $pdo, string $genre)
{
    $query = "INSERT INTO genres (name) VALUES (:name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $genre);
    $stmt->execute();
}

function add_author(object $pdo, string $name, String $lastname)
{
    $query = "INSERT INTO authors (name, last_name) VALUES (:name, :lastname)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->execute();
}