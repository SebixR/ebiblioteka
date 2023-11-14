<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book</title>
    <link rel="stylesheet" href="../css/book.css">
</head>
<body>

<header>
    <nav class="topnav">
        <a class="home" href="../index.php">Home</a>
        <?php
        if (isset($_SESSION["user_id"])) { ?>
            <a class="my-books" style="float:right" href="../views/my_books_view.php">My Books</a>
        <?php } else { ?>
            <a class="my-books" style="float:right" href="../views/login_view.php">My Books</a>
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
                    <form action="../php/logout.php" method="post" class="log-out">
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
            <a href="../views/login_view.php">
                <button class="log-in-button">Log in</button>
            </a>
        <?php }
        ?>
    </nav>
</header>

<div class="left-wrap">
    <div class="img-wrap">
        <img src="../images/lotr_cover.jpg" alt="Book Title" class="cover">
    </div>
</div>

<div class="right-wrap">
    <div class="book-info">
        <div class="info">
            <label>Title:</label>
            <label>Author:</label>
            <label>Publisher:</label>
            <label>Release Date:</label>
            <label>Pages:</label>
        </div>
        <hr>
        <div class="options">
            <div class="option">
                <label>Price</label>
                <button>Borrow</button>
            </div>
            <div class="option">
                <label>Price</label>
                <button>Purchase</button>
            </div>
        </div>
    </div>
    <article class="summary">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </article>
</div>

</body>