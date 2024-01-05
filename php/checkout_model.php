<?php

declare(strict_types=1);

function set_order(object $pdo, int $method, int $user_id, float $total_price)
{
    $query = "INSERT INTO orders (user_id, method_id, total_price) VALUES (:user_id, :method_id, :total)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":method_id", $method);
    $stmt->bindParam(":total", $total_price);
    $stmt->execute();
    $stmt = null;

    $query = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY date DESC LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    return $stmt;
}

function add_book_to_order($pdo, $order_id, $book_id, $purchased)
{
    if ($purchased)
    {
        $query = "INSERT INTO products_orders (order_id, purchase_id, borrowed_id) VALUES (:order_id, :purchase_id, 0)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->bindParam(":purchase_id", $book_id);
        $stmt->execute();
        $stmt = null;
    }
    else
    {
        $query = "INSERT INTO products_orders (order_id, purchase_id, borrowed_id) VALUES (:order_id, 0, :borrowed_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->bindParam(":borrowed_id", $book_id);
        $stmt->execute();
        $stmt = null;
    }
}

function set_purchased(object $pdo, int $bookcase_id, int $book_id): void
{
    $query = "INSERT INTO purchased (book_id, bookcase_id) VALUES (:book_id, :bookcase_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->bindParam(":bookcase_id", $bookcase_id);
    $stmt->execute();
    $stmt = null;
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
}

function fetch_bookcase(object $pdo, int $user_id): int
{
    $query = "SELECT * FROM bookcases WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)$row['bookcase_id'];
}