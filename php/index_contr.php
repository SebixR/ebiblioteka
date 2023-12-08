<?php

function get_genres(): void
{
    require_once "connection.php";
    require_once "index_model.php";

    $stmt = fetch_genres($pdo);
    if ($stmt){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<li>";
            echo "<label>";
            echo "<input type='checkbox' value={$row['name']} name='genres[]' class='genre-check'>{$row['name']}</input>";
            echo "<span class='checkmark'></span>";
            echo "</label>";
            echo "</li>";
        }
    }
}
