<?php

declare(strict_types=1);
function check_if_blocked($pdo, $id)
{
    $stmt = fetch_user_role($pdo, $id);
    $string = $stmt->fetch(PDO::FETCH_ASSOC)['role'];
    if ($string == 'blocked') return true;
    else return false;
}