<?php

declare(strict_types=1);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["block_user"])) {

    $user_id = (int)$_POST["user_id"];

    try {

        require_once 'connection.php';
        require_once "contr_panel_users_model.php";
        require_once "contr_panel_users_contr.php";

        if (check_if_blocked($pdo, $user_id))
        {
            set_user_role($pdo, $user_id, 'user');
        }
        else set_user_role($pdo, $user_id, 'blocked');

        $pdo = null;

        header("Location: ../views/contr_panel_users_view.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

function get_users(): void
{
    require_once "connection.php";
    require_once "contr_panel_users_model.php";
    require_once "contr_panel_users_contr.php";

    $stmt = fetch_users($pdo);
    if ($stmt){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = (int)$row['user_id'];
            $name = ucfirst($row['name']);
            $lastname = ucfirst($row['last_name']);
            $email = $row['email'];

            if (check_if_blocked($pdo, $id))
            {
                $button_text = 'Un-block';
            }
            else $button_text = 'Block';

            echo "<form class='user-wrap' action='../php/contr_panel_users.php' method='post'>";
                echo "<label class='user-content' style='width: 10%'>$id</label>";
                echo "<input type='hidden' name='user_id' value='$id'>";
                echo "<label class='user-content' style='width: 20%'>$name</label>";
                echo "<label class='user-content' style='width: 20%'>$lastname</label>";
                echo "<label class='user-content' style='width: 20%'>$email</label>";
                echo "<a class='user-content' style='width: 15%'>";
                    echo "<button>View Bookcase</button>";
                echo "</a>";
                echo "<div class='user-content' style='width: 15%'>";
                echo "<button type='submit' name='block_user'>$button_text</button>";
                echo "</div>";
            echo "</form>";
        }
    }
}
