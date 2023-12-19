<?php

declare(strict_types=1);

function get_books(): void
{

    require_once "connection.php";
    require_once "contr_panel_books_model.php";
    require_once "contr_panel_books_contr.php";

    $stmt = fetch_books($pdo);
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $title = ucfirst($row['title']);

            echo "<div>";
            echo "<p>$title</p>>";
            echo "</div>";
        }
    }
}
