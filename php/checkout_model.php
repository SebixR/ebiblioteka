<?php

declare(strict_types=1);

function set_purchased(object $pdo, int $bookcase_id, int $book_id): void
{
    $query = "INSERT INTO purchased (book_id, bookcase_id) VALUES (:book_id, :bookcase_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->bindParam(":bookcase_id", $bookcase_id);
    $stmt->execute();
    $stmt = null;

    $query = "UPDATE bookcases SET book_amount = book_amount + 1 WHERE bookcase_id = :bookcase_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":bookcase_id", $bookcase_id);
    $stmt->execute();
}

function set_borrowed(object $pdo, int $bookcase_id, int $book_id, string $date): void
{
    $query = "INSERT INTO borrowed (book_id, bookcase_id, rental_time) VALUES (:book_id, :bookcase_id, :date)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->bindParam(":bookcase_id", $bookcase_id);
    $stmt->bindParam(":date", $date);
    $stmt->execute();
    $stmt = null;

    $query = "UPDATE bookcases SET book_amount = book_amount + 1 WHERE bookcase_id = :bookcase_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":bookcase_id", $bookcase_id);
    $stmt->execute();
}

function fetch_bookcase(object $pdo, int $user_id): int
{
    $query = "SELECT * FROM bookcases WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['bookcase_id'];
}