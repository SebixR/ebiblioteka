<?php

declare(strict_types=1);
function check_user_role($pdo, $id): string
{
    $stmt = fetch_user_role($pdo, $id);
    return $stmt->fetch(PDO::FETCH_ASSOC)['role'];
}