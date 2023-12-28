<?php

declare(strict_types=1);

function fetch_books($pdo) {
    $query = "SELECT * FROM books";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function delete_book(object $pdo, int $book_id) {
    $query = "DELETE FROM author_book WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();

    $query = "DELETE FROM genre_book WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();

    $query = "DELETE FROM purchased WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();

    $query = "DELETE FROM borrowed WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();

    $query = "DELETE FROM books WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();
}
