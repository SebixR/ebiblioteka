<?php

declare(strict_types=1);

function edit_book(object $pdo, int $book_id, string $title, array $genres, array $authors, string $date, string $publisher, float $purchase, float $borrow, int $pages, string $summary, string $cover)
{
    //get the publisher's id
    $query_publisher = "SELECT publisher_id FROM publishers WHERE name = :publisher";
    $stmt = $pdo->prepare($query_publisher);
    $stmt->bindParam(":publisher", $publisher);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $result['publisher_id'];

    $stmt_book = fetch_book_info($pdo, $book_id);
    $row = $stmt_book->fetch(PDO::FETCH_ASSOC);
    $backup_cover = $row['cover_img'];

    //add new book
    $query = "UPDATE books SET title = :title, publisher_id = :publisher_id, release_date = :release_date,
                 purchase_price = :purchase_price, borrow_price = :borrow_price, page_number = :page_number,
                 summary = :summary, cover_img = :cover WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":publisher_id", $id);
    $stmt->bindParam(":release_date", $date);
    $stmt->bindParam(":purchase_price", $purchase);
    $stmt->bindParam(":borrow_price", $borrow);
    $stmt->bindParam(":page_number", $pages);
    $stmt->bindParam(":summary", $summary);
    if (strlen($cover) == 0) $stmt->bindParam(":cover", $backup_cover);
    else $stmt->bindParam(":cover", $cover);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();

    //bind book with its authors
    $query = "DELETE FROM author_book WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();

    $counter = 0;
    foreach ($authors as $author)
    {
        if ($counter >= 10) break;

        //find author in the authors table
        $query_author = "SELECT author_id FROM authors WHERE name = :name AND last_name = :last_name";
        $stmt = $pdo->prepare($query_author);
        $stmt->bindParam(":name", $author['name']);
        $stmt->bindParam(":last_name", $author['lastname']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $author_id = $result['author_id'];

        //get the new book's id
        $query_book = "SELECT book_id FROM books WHERE title = :title";
        $stmt = $pdo->prepare($query_book);
        $stmt->bindParam(":title", $title);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $book_id = $result['book_id'];

        //add both the book's and author's ids to author_book
        $query = "INSERT INTO author_book (book_id, author_id) VALUES (:book_id, :author_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":book_id", $book_id);
        $stmt->bindParam(":author_id", $author_id);
        $stmt->execute();

        $counter++;
    }

    //bind book with its genres
    $query = "DELETE FROM genre_book WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();

    foreach ($genres as $genre)
    {
        //find genre in the genres table
        $query_author = "SELECT genre_id FROM genres WHERE name = :name";
        $stmt = $pdo->prepare($query_author);
        $stmt->bindParam(":name", $genre);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $genre_id = $result['genre_id'];

        //get the new book's id
        $query_book = "SELECT book_id FROM books WHERE title = :title";
        $stmt = $pdo->prepare($query_book);
        $stmt->bindParam(":title", $title);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $book_id = $result['book_id'];

        //add both the book's and genre's ids to genre_book
        $query = "INSERT INTO genre_book (book_id, genre_id) VALUES (:book_id, :genre_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":book_id", $book_id);
        $stmt->bindParam(":genre_id", $genre_id);
        $stmt->execute();
    }
}

function fetch_book_info(object $pdo, int $book_id)
{
    $query = "SELECT * FROM books WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();
    return $stmt;
}

function fetch_genres(object $pdo)
{
    $query = "SELECT * FROM genres";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function fetch_book_has_genre(object $pdo, int $book_id, int $genre_id)
{
    $query = "SELECT * FROM genre_book WHERE book_id = :book_id AND genre_id = :genre_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->bindParam(":genre_id", $genre_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function fetch_authors($pdo, $book_id)
{
    $query = "SELECT * FROM author_book WHERE book_id = :book_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":book_id", $book_id);
    $stmt->execute();
    return $stmt;
}

function fetch_author_info($pdo, $author_id)
{
    $query = "SELECT * FROM authors WHERE author_id = :author_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":author_id", $author_id);
    $stmt->execute();
    return $stmt;
}

function fetch_publisher(object $pdo, int $publisher_id)
{
    $query = "SELECT * FROM publishers WHERE publisher_id = :publisher_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":publisher_id", $publisher_id);
    $stmt->execute();
    return $stmt;
}

function find_authors(object $pdo, array $authors): bool
{
    foreach ($authors as $author)
    {
        $query = "SELECT author_id FROM authors WHERE name = :name AND last_name = :last_name";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $author['name']);
        $stmt->bindParam(":last_name", $author['lastname']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) return false;
    }

    return true;
}

function find_publisher(object $pdo, string $publisher): bool
{
    $query_publisher = "SELECT publisher_id FROM publishers WHERE name = :publisher";
    $stmt = $pdo->prepare($query_publisher);
    $stmt->bindParam(":publisher", $publisher);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) return false;
    return true;
}
