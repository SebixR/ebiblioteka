<?php

function fetch_users(object $pdo)
{
    $query = "SELECT * FROM users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}
