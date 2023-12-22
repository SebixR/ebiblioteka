<?php

declare(strict_types=1);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["block_user"])) {

    $user_id = (int)$_POST["user_id"];

    try {
        require_once 'connection.php';
        require_once "contr_panel_users_model.php";
        require_once "contr_panel_users_contr.php";

        if (check_user_role($pdo, $user_id) != 'admin')
        {
            if (check_user_role($pdo, $user_id) == 'blocked')
            {
                set_user_role($pdo, $user_id, 'user');
            }
            else set_user_role($pdo, $user_id, 'blocked');

            $pdo = null;

            header("Location: ../views/contr_panel_users_view.php");
            die();
        }
        else
        {
            $pdo = null;
            header("Location: ../views/contr_panel_users_view.php");
            die();
        }
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

function get_users(): void
{
    require "connection.php";
    require_once "contr_panel_users_model.php";
    require_once "contr_panel_users_contr.php";

    $stmt = fetch_users($pdo);
    if ($stmt){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = (int)$row['user_id'];
            $name = ucfirst($row['name']);
            $lastname = ucfirst($row['last_name']);
            $email = $row['email'];

            if (check_user_role($pdo, $id) == 'blocked')
            {
                $button_text = 'Un-block';
            }
            else if (check_user_role($pdo, $id) == 'admin')
            {
                $button_text = 'Admin';
            }
            else $button_text = 'Block';

            echo "<form class='user-wrap' action='../php/contr_panel_users.php' method='post'>";
                echo "<label class='user-content' style='width: 10%'>$id</label>";
                echo "<input type='hidden' name='user_id' value='$id'>";
                echo "<label class='user-content' style='width: 20%'>$name</label>";
                echo "<label class='user-content' style='width: 20%'>$lastname</label>";
                echo "<label class='user-content' style='width: 20%'>$email</label>";
                echo "<div class='user-content' style='width: 15%'>";
                echo "<a class='view-bookcase' href='../views/my_books_view.php?id=$id' class='user-content'>View Bookcase</a>";
                echo "</div>";
                echo "<div class='user-content' style='width: 15%'>";
                echo "<button type='submit' name='block_user'>$button_text</button>";
                echo "</div>";
            echo "</form>";
        }
    }
}
