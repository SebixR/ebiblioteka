<?php
require_once '../php/config_session.php';
require_once '../php/basket.php';
require_once '../php/topnav_contr.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basket</title>
    <link rel="stylesheet" href="../css/basket.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <h2>
        Basket
    </h2>

    <script>
        function displayItems() {
            // Retrieve items from localStorage
            const items = JSON.parse(localStorage.getItem("cartItems")) || [];

            // Display items in a list
            let list = "<div class='items'>";
            items.forEach(function(item, index) {
                list += "<div class='item-wrap'>";
                list += "<label class='item-content' style='width: 25%'>" + item.title + " </label>";
                list += "<label class='item-content' style='width: 25%'>" + item.price.toFixed(2) + " $</label>"
                if (parseInt(item.time) === 0)
                {
                    list += "<label class='item-content' style='width: 25%'>Forever</label>"
                }
                else if (parseInt(item.time) === 30 || parseInt(item.time) === 7)
                {
                    list += "<label class='item-content' style='width: 25%'>" + item.time + " Days</label>"
                }
                else list += "<label class='item-content' style='width: 25%'>" + item.time + " Hours</label>"
                list += "<button onclick='removeItem(" + index + ")'>Delete</button>";
                list += "</div>";
            });
            list += "</div>";

            // Display the list in the HTML
            document.getElementById("basket-wrap").innerHTML = list;
        }

        function setItemsToLocalStorage(items) {
            localStorage.setItem('cartItems', JSON.stringify(items));
        }

        function removeItem(index) {
            // Retrieve items from localStorage
            const items = JSON.parse(localStorage.getItem("cartItems")) || [];

            // Remove the item from the array and update localStorage
            items.splice(index, 1);
            setItemsToLocalStorage(items);

            // Regenerate the list
            displayItems();
        }
    </script>

    <form class="basket" id="basket">
        <div id="basket-wrap">
            <script>
                displayItems();
            </script>
        </div>
        <button class="basket-submit" type="submit">Continue</button>
    </form>

</div>
</body>
