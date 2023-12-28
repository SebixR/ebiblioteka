<?php

declare(strict_types=1);

function fetch_user_info($pdo, $user_id)
{
    $query = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    return $stmt;
}