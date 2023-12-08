<?php

function get_genres(): void
{
    require_once "connection.php";
    require_once "index_model.php";

    $stmt = fetch_genres($pdo);
    if ($stmt){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $value = ucfirst($row['name']);
            echo "<li>";
            echo "<label>";
            echo "<input type='checkbox' value=$value name='genres[]' class='genre-check'>$value</input>";
            echo "<span class='checkmark'></span>";
            echo "</label>";
            echo "</li>";
        }
    }
}
