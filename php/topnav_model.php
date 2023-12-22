<?php

declare(strict_types=1);

function fetch_user_role_topnav(object $pdo, int $user_id)
{
    $query = "SELECT role FROM users where user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    return $stmt;
}
