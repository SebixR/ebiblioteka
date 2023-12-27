<?php
require_once '../php/config_session.php';
require_once '../php/book_contr.php';
?>

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
    <?php
    require_once '../php/topnav.php';
    ?>
</header>

<?php
$book_id = $_GET['id'] ?? null;
?>

<div class="left-wrap">
    <div class="img-wrap">
        <?php
        get_cover_image($book_id);
        ?>
    </div>
</div>

<div class="right-wrap">
    <div class="book-info">
        <div class="info">
            <?php
            get_book_info($book_id);
            ?>
        </div>
        <hr>
        <div class="options">
            <div class="option">
                <label id="borrow_price_label">Pick a time period</label>
                <div class="dropdown">
                    <button onclick="showPrices()" class="borrow-drop" id="borrow_button">Pick time</button>
                    <form id="dropdown-prices" class="borrow-options">
                        <label>
                            <input id="price1" name="prices" type="radio" value="12.99" class='price-check' onchange='get_current_price()'>30 Days: 12.99$
                            <span class='checkmark'></span>
                        </label>
                        <label>
                            <input id="price2" name="prices" type="radio" value="2.99" class='price-check' onchange='get_current_price()'>7 Days: 2.99$
                            <span class='checkmark'></span>
                        </label>
                        <label>
                            <input id="price3" name="prices" type="radio" value="0.99" class='price-check' onchange='get_current_price()'>24 Hours: 0.99$
                            <span class='checkmark'></span>
                        </label>
                    </form>
                </div>

            </div>
            <div class="option">
                <label>Price</label>
                <button>Purchase</button>
            </div>

            <script>
                function showPrices() {
                    document.getElementById("dropdown-prices").classList.toggle("show");
                }

                window.onclick = function(event) {
                    if (!event.target.matches('.borrow-drop')) {
                        const dropdowns = document.getElementsByClassName("borrow-options");
                        let i;
                        for (i = 0; i < dropdowns.length; i++) {
                            const openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                        }
                    }
                }

                function get_current_price()
                {
                    let price = document.querySelector('input[name="prices"]:checked').value;
                    document.getElementById("borrow_price_label").textContent = price + " $";

                    const radio1Selected = document.getElementById('price1').checked;
                    const radio2Selected = document.getElementById('price2').checked;
                    const radio3Selected = document.getElementById('price3').checked;

                    if (radio1Selected) {
                        document.getElementById("borrow_button").textContent = "30 Days";
                    } else if (radio2Selected) {
                        document.getElementById("borrow_button").textContent = "7 Days";
                    } else if (radio3Selected) {
                        document.getElementById("borrow_button").textContent = "24 Hours";
                    } else {
                        document.getElementById("borrow_button").textContent = "Pick time";
                    }
                }
            </script>

        </div>
    </div>
</div>

<div class="summary-wrap">
    <h3>
        Summary:
    </h3>
    <?php
    get_summary($book_id);
    ?>
</div>


</body>