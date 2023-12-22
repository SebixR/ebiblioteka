<?php

function fetch_books_main(object $pdo)
{
    $query = "SELECT * FROM books";
    $stmt = $pdo->prepare($query);
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

