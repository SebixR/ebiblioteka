<?php

function getBooks($pdo)
{
    $query = "SELECT * FROM books;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
