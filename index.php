<?php
require_once 'php/config_session.php';
require_once 'php/login.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>

<h3>
    <?php
    output_name();
    ?>
</h3>

<div class="main">
    <header>
        <nav class="topnav">
            <a class="home" href="index.php">Home</a>
            <?php
            if (isset($_SESSION["user_id"])) { ?>
                <a class="my-books" style="float:right" href="views/my_books_view.php">My Books</a>
            <?php } else { ?>
                <a class="my-books" style="float:right" href="views/login_view.php">My Books</a>
            <?php } ?>

            <div class="search-wrap">
                <form>
                    <input type="text" class="search" placeholder="Search">
                    <button type="submit" class="search-button">Go</button>
                </form>
            </div>
            <?php
            if (isset($_SESSION["user_id"])) { ?>
                <div class="dropdown" onclick="dropDown()">
                    <button class="settings">Test</button>
                    <div class="dropdown-content" id="dropdown">
                        <a href="#">
                            <button class="settings-button">Settings</button>
                        </a>
                        <form action="php/logout.php" method="post" class="log-out">
                            <button class="log-out-button">Log out</button>
                        </form>
                    </div>
                </div>
                <script>
                    function dropDown() {
                        document.getElementById("dropdown").classList.toggle("show-dropdown");
                    }

                    window.onclick = function(event) {
                        if (!event.target.matches('.settings')) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('show-dropdown')) {
                                    openDropdown.classList.remove('show-dropdown');
                                }
                            }
                        }
                    }
                </script>
            <?php } else { ?>
                <a href="views/login_view.php">
                    <button class="log-in-button">Log in</button>
                </a>
            <?php }
            ?>
        </nav>
    </header>

    <section>
        <nav class="sidenav">
            <div class="genre-wrap">
                <label>Genres</label>
                <div class="list-wrap">
                    <ul class="genre-list">
                        <li>
                            <label>
                                Genre 1<input class="genre-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label>
                                Genre 2<input class="genre-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label>
                                Genre 3<input class="genre-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label>
                                Genre 4<input class="genre-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label>
                                Genre 5<input class="genre-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label>
                                Genre 6<input class="genre-check" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                </div>

            </div>
            <hr>
            <div class="author-wrap">
                <label>Author</label>
                <input class="textbox" type="text" placeholder="Author's name">
            </div>
            <hr>
            <div class="publisher-wrap">
                <label>Publisher</label>
                <input class="textbox" type="text" placeholder="Publisher's name">
            </div>
        </nav>

        <div class="main-content">
            <div class="row">
                <div class="half-row">
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/lotr_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/hp_cover_altered.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                </div>

                <div class="half-row">
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/hp_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/lotr_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="half-row">
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/lotr_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/hp_cover_altered.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                </div>

                <div class="half-row">
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/hp_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/lotr_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                </div>
                </div>


            <div class="row">
                <div class="half-row">
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/lotr_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/hp_cover_altered.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                </div>

                <div class="half-row">
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/hp_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="#Book" class="image-link">
                            <img src="images/lotr_cover.jpg" class="image" alt="Book Title">
                        </a>
                        <div class="item-info">
                            <h3>
                                <a href="#Book" class="title">Title</a>
                            </h3>
                            <p>Borrow Price</p>
                            <p>Purchase Price</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>


</body>
</html>

