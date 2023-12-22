<?php

declare(strict_types=1);

function fetch_book_info(object $pdo, int $book_id)
{
    $query = "SELECT * FROM books WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();
    return $stmt;
}

function fetch_genres(object $pdo)
{
    $query = "SELECT * FROM genres";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function fetch_publisher(object $pdo, int $publisher_id)
{
    $query = "SELECT * FROM publishers WHERE publisher_id = :publisher_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":publisher_id", $publisher_id);
    $stmt->execute();
    return $stmt;
}
