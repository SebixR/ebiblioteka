<?php

declare(strict_types=1);

function get_users(): void
{
    require_once "connection.php";
    require_once "contr_panel_users_model.php";

    $stmt = fetch_users($pdo);
    if ($stmt){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row['user_id'];
            $name = ucfirst($row['name']);
            $lastname = ucfirst($row['last_name']);
            $email = $row['email'];

            echo "<div class='user-wrap'>";
                echo "<label class='user-content' style='width: 10%'>$id</label>";
                echo "<label class='user-content' style='width: 20%'>$name</label>";
                echo "<label class='user-content' style='width: 20%'>$lastname</label>";
                echo "<label class='user-content' style='width: 20%'>$email</label>";
                echo "<a class='user-content' style='width: 15%'>";
                    echo "<button>View Bookcase</button>";
                echo "</a>";
                echo "<div class='user-content' style='width: 15%'>";
                echo "<button>Delete</button>";
                echo "</div>";
            echo "</div>";
        }
    }
}
