<?php

declare(strict_types=1);

function fetch_books($pdo) {
    $query = "SELECT * FROM books";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}