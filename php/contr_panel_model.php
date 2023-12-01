<?php

require_once "connection.php";

function add_book(object $pdo, string $title, array $authors, string $date, string $publisher, float $purchase, float $borrow, int $pages, string $summary, string $filename)
{
    $query = "INSERT INTO books (cover_img) VALUES (:filename)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":filename", $filename);
    $stmt->execute();
}

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

function add_publisher(object $pdo, string $publisher)
{
    $query = "INSERT INTO publishers (name) VALUES (:name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $publisher);
    $stmt->execute();
}
