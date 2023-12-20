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
}

function set_book_display(array $row): void
{
    $title = $row['title'];
    $image = $row['cover_img'];
    $borrow_price = $row['borrow_price'];
    $purchase_price = $row['purchase_price'];

    echo "<div class='item'>";
    echo "<a href='#Book' class='image-link'>";
    echo"<img src='../images/$image' class='image' alt='Book Title'>";
    echo "</a>";
    echo "<div class='item-info'>";
    echo "<h3>";
    echo "<a href='#Book' class='title'>$title</a>";
    echo "</h3>";
    echo "<p>Borrow: $borrow_price</p>";
    echo "<p>Purchase: $purchase_price</p>";
    echo "</div>";
    echo "</div>";
}
