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

function fetch_book_has_genre(object $pdo, int $book_id, int $genre_id)
{
    $query = "SELECT * FROM genre_book WHERE book_id = :book_id AND genre_id = :genre_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->bindParam(":genre_id", $genre_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function fetch_authors($pdo, $book_id)
{
    $query = "SELECT * FROM author_book WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();
    return $stmt;
}

function fetch_author_info($pdo, $author_id)
{
    $query = "SELECT * FROM authors WHERE author_id = :author_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":author_id", $author_id);
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
