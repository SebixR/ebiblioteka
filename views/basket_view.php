<?php
require_once '../php/config_session.php';
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

    <h3>
        Basket
    </h3>

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
            displayTotalPrice()
        }

        function displayTotalPrice()
        {
            // Retrieve items from localStorage
            const items = JSON.parse(localStorage.getItem("cartItems")) || [];
            let price = 0;
            items.forEach(function(item) {
                price += item.price;
            });

            price = price.toFixed(2);

            document.getElementById("total").innerHTML = "Total: " + price + " $";
        }


    </script>

    <div class="basket" id="basket">
        <div id="basket-wrap">
            <script>
                displayItems();
            </script>
        </div>

        <h3 id="total"></h3>

        <script>
            displayTotalPrice();
        </script>

        <a href="checkout_view.php">
            <button class="basket-submit" id="continue">Continue</button>
        </a>

        <script>
            function lockContinueButton()
            {
                const button = document.getElementById('continue');
                // Retrieve items from localStorage
                const items = JSON.parse(localStorage.getItem("cartItems")) || [];
                if (items.length === 0)
                {
                    button.disabled = true;
                }
            }
            lockContinueButton();
        </script>

    </div>

</div>
</body>
