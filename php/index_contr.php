<?php

function get_books_main(): void
{
    require "connection.php";
    require_once "index_model.php";

    $stmt = fetch_books_main($pdo);
    if ($stmt)
    {
        $counter = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if ($counter == 0) //two half-rows in single row
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
            if ($counter == 2) //end of row
            {
                echo "</div>";
                $counter = 0;
            }
        }
        if ($counter < 2) //empty rows so that it all looks nice
        {
            $i = $counter;
            while ($i < 2)
            {
                echo "<div class='half-row'>";
                echo "</div>";
                $i++;
            }
        }
        if ($counter % 2 != 0)
        {
            echo "</div>"; //in case the number of books isn't divisible by 2
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

    echo "<div class='item'>";
    echo "<a href='views/book_view.php?id=$book_id' class='image-link'>";
    echo "<img src='images/$image' class='image' alt='$title'>";
    echo "</a>";
    echo "<div class='item-info'>";
    echo "<h3>";
    echo "<a href='views/book_view.php?id=$book_id' class='title'>$title</a>";
    echo "</h3>";
    echo "<p>Borrow: $borrow_price $</p>";
    echo "<p>Purchase: $purchase_price $</p>";
    echo "</div>";
    echo "</div>";
}

function get_genres(): void
{
    require "connection.php";
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
