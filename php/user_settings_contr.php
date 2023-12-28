<?php

declare(strict_types=1);

function get_user_info($user_id): void
{
    try {
        require "connection.php";
        require_once "user_settings_model.php";

        $stmt = fetch_user_info($pdo, $user_id);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = ucfirst($row['name']);
        $lastname = ucfirst($row['last_name']);
        $email = $row['email'];

        echo "<label> Name";
        echo "<input value='$name' type='text' class='textbox' name='name' placeholder='Name'>";
        echo "</label>";
        echo "<label> Last Name";
        echo "<input value='$lastname' type='text' class='textbox' name='lastname' placeholder='Last Name'>";
        echo "</label>";
        echo "<label> Email Address";
        echo "<input value='$email' class='textbox' disabled>";
        echo "</label>";

    } catch (Exception $e)
    {
        die("Query failed: " . $e->getMessage());
    }
}