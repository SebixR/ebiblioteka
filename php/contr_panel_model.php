<?php

require_once "connection.php";

function add_book(object $pdo, string $title, array $genres, array $authors, string $date, string $publisher, float $purchase, float $borrow, int $pages, string $summary, string $filename)
{
    //get the publisher's id
    $query_publisher = "SELECT publisher_id FROM publishers WHERE name = :publisher";
    $stmt = $pdo->prepare($query_publisher);
    $stmt->bindParam(":publisher", $publisher);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $result['publisher_id'];

    //add new book
    $query = "INSERT INTO books (title, publisher_id, release_date, purchase_price, borrow_price, page_number, summary, cover_img) VALUES (:title, :publisher_id, :date, :purchase_price, :borrow_price, :page_number, :summary, :filename)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":publisher_id", $id);
    $stmt->bindParam(":filename", $filename);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":purchase_price", $purchase);
    $stmt->bindParam(":borrow_price", $borrow);
    $stmt->bindParam(":page_number", $pages);
    $stmt->bindParam(":summary", $summary);
    $stmt->execute();

    //bind book with its authors
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

function find_genre(object $pdo, string $genre): bool
{
    $query = "SELECT genre_id FROM genres WHERE name = :genre";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":genre", $genre);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) return false;
    else return true;
}

function find_author(object $pdo, string $name, string $lastname): bool
{
    $query = "SELECT author_id FROM authors WHERE name = :name AND last_name = :last_name";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":last_name", $lastname);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) return false;
    else return true;
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

function find_genre_connections(object $pdo, string $genre): bool
{
    //get the genre's id
    $query_genre = "SELECT genre_id FROM genres WHERE name = :genre";
    $stmt = $pdo->prepare($query_genre);
    $stmt->bindParam(":genre", $genre);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result){
        $genre_id = $result['genre_id'];
        $query = "SELECT * FROM genre_book WHERE genre_id = :genre_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":genre_id", $genre_id);
        $stmt->execute();
        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result2) return true;
        else return false;
    }
    return false;
}

function find_publisher_connections(object $pdo, string $publisher): bool
{
    //get the publisher's id
    $query_publisher = "SELECT publisher_id FROM publishers WHERE name = :publisher";
    $stmt = $pdo->prepare($query_publisher);
    $stmt->bindParam(":publisher", $publisher);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result){
        $publisher_id = $result['publisher_id'];
        $query = "SELECT * FROM books WHERE publisher_id = :publisher_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":publisher_id", $publisher_id);
        $stmt->execute();
        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result2) return true;
        else return false;
    }
    return false;
}

function find_author_connections($pdo, $name, $lastname): bool
{
    //get the author's id
    $query_author = "SELECT author_id FROM authors WHERE name = :name AND last_name = :lastname";
    $stmt = $pdo->prepare($query_author);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result){
        $author_id = $result['author_id'];
        $query = "SELECT * FROM author_book WHERE author_id = :author_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":author_id", $author_id);
        $stmt->execute();
        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result2) return true;
        else return false;
    }
    return false;
}

function fetch_genres(object $pdo)
{
    $query = "SELECT * FROM genres";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function add_genre(object $pdo, string $genre)
{
    $query = "INSERT INTO genres (name) VALUES (:name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $genre);
    $stmt->execute();
}

function delete_genre(object $pdo, string $genre)
{
    $query = "DELETE FROM genres WHERE name = :name";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $genre);
    $stmt->execute();
}

function add_author(object $pdo, string $name, String $lastname)
{
    $query = "INSERT INTO authors (name, last_name) VALUES (:name, :lastname)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->execute();
}

function delete_author(object $pdo, string $name, string $lastname): void
{
    $query = "DELETE FROM authors WHERE name = :name AND last_name = :lastname";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->execute();
}

function add_publisher(object $pdo, string $publisher)
{
    $query = "INSERT INTO publishers (name) VALUES (:name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $publisher);
    $stmt->execute();
}

function delete_publisher(object $pdo, string $publisher)
{
    $query = "DELETE FROM publishers WHERE name = :name";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $publisher);
    $stmt->execute();
}
