<?php

declare(strict_types=1);

function is_input_empty(string $title, array $genres, array $authors, string $date, string $publisher, float $purchase, float $borrow, int $pages, string $summary, string $filename): bool
{
    if (empty($title) || empty($genres) || empty($authors) || empty($date) || empty($publisher) || empty($purchase) || empty($borrow) || empty($pages) || empty($summary) || empty($filename)) {
        return true;
    } else return false;
}

function check_authors(object $pdo, array $authors): bool
{
    if (find_authors($pdo, $authors)) return false;
    else return true;
}

function check_genre(object $pdo, string $genre): bool
{
    if (find_genre($pdo, $genre)) return false;
    else return true;
}

function check_genre_connections(object $pdo, string $genre): bool
{
    if (find_genre_connections($pdo, $genre)) return true;
    else return false;
}

function check_duplicate_genre(object $pdo, string $genre): bool
{
    if (find_duplicate_genre($pdo, $genre)) return false;
    else return true;
}


function check_author(object $pdo, string $name, string $lastname): bool
{
    if (find_author($pdo, $name, $lastname)) return false;
    else return true;
}

function check_author_connections(object $pdo, string $name, string $lastname): bool
{
    if (find_author_connections($pdo, $name, $lastname)) return true;
    else return false;
}

function check_duplicate_author(object $pdo, string $name, string $lastname): bool
{
    if (find_duplicate_author($pdo, $name, $lastname)) return false;
    else return true;
}

function check_publisher(object $pdo, string $publisher): bool
{
    if (find_publisher($pdo, $publisher)) return false;
    else return true;
}

function check_publisher_connections(object $pdo, string $publisher): bool
{
    if (find_publisher_connections($pdo, $publisher)) return true;
    else return false;
}

function check_duplicate_publisher(object $pdo, string $publisher): bool
{
    if (find_duplicate_publisher($pdo, $publisher)) return false;
    else return true;
}
