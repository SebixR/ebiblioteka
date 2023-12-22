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

function get_genres(int $book_id): void
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
                if (book_has_genre($book_id, $row['genre_id']))
                {
                    echo "<input type='checkbox' value='$value' name='genres[]' class='genre-check' checked>$value</input>";
                }
                else echo "<input type='checkbox' value='$value' name='genres[]' class='genre-check'>$value</input>";
                echo "<span class='checkmark'></span>";
                echo "</label>";
                echo "</li>";
            }
        }
    } catch (Exception $e){
        die("Query failed: " . $e->getMessage());
    }
}

function book_has_genre(int $book_id, int $genre_id): bool
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    if (fetch_book_has_genre($pdo, $book_id, $genre_id) == 1) return true;
    else return false;
}

function get_authors(int $book_id): array
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    $stmt = fetch_authors($pdo, $book_id);

    $authors = array();
    $index = 0;
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $author_data = get_author_info($row['author_id']);

            $authors[$index]['name'] = $author_data['name'];
            $authors[$index]['lastname'] = $author_data['last_name'];
            $index++;
        }
    }

    return $authors;
}

function get_author_info($author_id)
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    $stmt = fetch_author_info($pdo, $author_id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_publisher_name($publisher_id): string
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    $stmt = fetch_publisher($pdo, $publisher_id);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($publisher['name']);
}
