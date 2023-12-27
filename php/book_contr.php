<?php

declare(strict_types=1);

function get_cover_image(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $image = $row['cover_img'];

    echo "<img src='../images/$image' alt='Book Title' class='cover'>";
}

function get_book_info(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $publisher_id = $row['publisher_id'];
    $publisher = get_publisher_name($publisher_id);
    $release_date = $row['release_date'];
    $pages = $row['page_number'];
    $stmt = null;

    $stmt = fetch_authors($pdo, $book_id);

    echo "<label>Title: $title</label>";
    echo "<label>Author/s:</label>";
    echo "<div class='authors-or-genres'>";
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $author_data = get_author_info($row['author_id']);
            $name = ucfirst($author_data['name']);
            $lastname = ucfirst($author_data['last_name']);

            echo "<label>$name $lastname  </label>";
        }
    }
    $stmt = null;
    echo "</div>";
    echo "<label>Publisher: $publisher</label>";
    echo "<label>Release Date: $release_date</label>";
    echo "<label>Pages: $pages</label>";
    echo "<label>Genres:</label>";
    echo "<div class='authors-or-genres''>";
    $stmt = fetch_genres($pdo, $book_id);
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $genre_name = get_genre_name($row['genre_id']);
            echo "<label>$genre_name    </label>";
        }
    }
    echo "</div>";
}

function get_author_info(int $author_id)
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_author_info($pdo, $author_id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_genre_name(int $genre_id): string
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_genre_name($pdo, $genre_id);
    $genre = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($genre['name']);
}

function get_publisher_name(int $publisher_id): string
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_publisher($pdo, $publisher_id);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($publisher['name']);
}

function get_summary(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $summary = $row['summary'];

    echo "<article class='summary'>";
    echo "$summary";
    echo "</article>";
}

function get_borrow_prices(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $base_price = $row['borrow_price'];
    $week_price = number_format($base_price * 0.4 + 1, 2);
    $day_price = number_format($base_price * 0.1 + 0.5, 2);

    echo "<label id='borrow_price_label'>Pick a time period</label>";
    echo "<div class='dropdown'>";
    echo "<button onclick='showPrices()' class='borrow-drop' id='borrow_button'>Pick time</button>";
    echo "<form id='dropdown-prices' class='borrow-options'>";
    echo "<label>";
    echo "<input id='price1' name='prices' type='radio' value=$base_price class='price-check' onchange='get_current_price()'>30 Days: $base_price $";
    echo "<span class='checkmark'></span>";
    echo "</label>";
    echo "<label>";
    echo "<input id='price2' name='prices' type='radio' value=$week_price class='price-check' onchange='get_current_price()'>7 Days: $week_price $";
    echo "<span class='checkmark'></span>";
    echo "</label>";
    echo "<label>";
    echo "<input id='price3' name='prices' type='radio' value=$day_price class='price-check' onchange='get_current_price()'>24 Hours: $day_price $";
    echo "<span class='checkmark'></span>";
    echo "</label>";
    echo "</form>";
    echo "</div>";
}

function get_purchase_price(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $price = $row['purchase_price'];

    echo "<label>$price $</label>";
}
