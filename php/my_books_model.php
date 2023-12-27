<?php

declare(strict_types=1);

function fetch_borrowed_books($pdo, $bookcase_id)
{
    $query = "SELECT * FROM borrowed WHERE bookcase_id = :bookcase_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":bookcase_id", $bookcase_id);
    $stmt->execute();
    return $stmt;
}

function fetch_bookcase(object $pdo, int $user_id)
{
    $query = "SELECT * FROM bookcases WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    return $stmt;
}

function fetch_book_info(object $pdo, int $book_id)
{
    $query = "SELECT * FROM books WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();
    return $stmt;
}
