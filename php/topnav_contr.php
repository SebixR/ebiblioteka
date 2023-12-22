<?php

declare(strict_types=1);

function get_user_role(int $user_id)
{
    require "connection.php";
    require_once "topnav_model.php";

    $stmt = fetch_user_role_topnav($pdo, $user_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['role'];
}
