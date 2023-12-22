<?php

declare(strict_types=1);

function get_book_info(int $book_id) {

    try {
        require_once "connection.php";
        require_once "contr_panel_edit_model.php";

        $stmt = fetch_book_info($pdo, $book_id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e){
        die("Query failed: " . $e->getMessage());
    }

}

function get_genres(): void
{
    try {
        require "connection.php"; //require, not require_once because require_once checks if it's already been required,
        //and if so, doesn't do it again. I think that the require_once in get book info makes it not import it again
        require_once "contr_panel_edit_model.php";

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
    } catch (Exception $e){
        die("Query failed: " . $e->getMessage());
    }

}

function get_publisher_name($publisher_id)
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    $stmt = fetch_publisher($pdo, $publisher_id);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($publisher['name']);
}
