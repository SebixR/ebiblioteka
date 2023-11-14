<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Books</title>
    <link rel="stylesheet" href="../css/my_books.css">
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

<div class="borrowed-h">
    <h2>Borrowed</h2>
</div>
<div class="borrowed-wrap">
    <div class="borrowed-imgs">
        <div class="item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
        <div class="item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
        <div class="item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
        <div class="item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
    </div>
</div>

<div class="purchased-h">
    <h2>Purchased</h2>
</div>
<div class="purchased-wrap">
    <div class="row">
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>

    </div>
</div>


</body>
