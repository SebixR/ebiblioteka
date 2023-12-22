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
        $counter = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if ($counter == 0) //three half-rows in single row
            {
                echo "<div class='row'>";
            }

            echo "<div class='half-row'>";

            set_book_display($row);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                set_book_display($row);
            }

            echo "</div>";
            $counter++;
            if ($counter == 3) //end of row
            {
                echo "</div>";
            }
        }
        if ($counter % 3 != 0)
        {
            echo "</div>"; //in case the number of books isn't divisible by 3
        }
    }
    $stmt = null;
}

function set_book_display(array $row): void
{
    $title = $row['title'];
    $image = $row['cover_img'];
    $borrow_price = $row['borrow_price'];
    $purchase_price = $row['purchase_price'];
    $book_id = $row['book_id'];

    echo "<form class='item' action='../php/contr_panel_books.php' method='post'>";
    echo "<div class='image-wrap'>";
    echo"<img src='../images/$image' class='image' alt=$title>";
    echo "</div>";
    echo "<div class='item-info'>";
    echo "<h3>";
    echo "<a href='#Book' class='title'>$title</a>";
    echo "</h3>";
    echo "<p>Borrow: $borrow_price $</p>";
    echo "<p>Purchase: $purchase_price $</p>";
    echo "</div>";
    echo "<a href='../views/contr_panel_edit_view.php?id=$book_id' class='book-button' style='bottom:50%'>Edit</a>";
    echo "<button class='book-button' name='delete_book'>Delete</button>";
    echo "<input type='hidden' name='book_id' value=$book_id>";
    echo "</form>";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_book"])) {

    $book_id = (int)$_POST["book_id"];

    try {
        require_once 'connection.php';
        require_once "contr_panel_books_model.php";

        delete_book($pdo, $book_id);

        $pdo = null;
        header("Location: ../views/contr_panel_books_view.php");
        die();

    } catch (Exception $e) {
        die("Query failed: " . $e->getMessage());
    }
}
