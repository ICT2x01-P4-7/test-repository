<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php
        include "../HeaderFile/header.php"
        ?>
        <title>Money Game</title>
        <link rel="stylesheet" href="moneygame.css"/>
        <script>
            $(document).ready(function () {

                $(".amounttext>p").html("$" + value);

            });
            let value = Math.floor((Math.random() * 100) + 1);

            function minusAmount(quantity) {
                value = value - quantity;
                console.log(value);

                if (value == 0){
                    $(".amounttext>p").html("Yay");
                    return;
                }
                else if(value < 0) {
                    $(".amounttext>p").html("Amount is over");
                    return;
                };

                $(".amounttext>p").html("$" + value);
            }


        </script>
    </head>
    <body>
        <?php
        include "../NavBar/navigationbar.php"
        ?>
        <!--        <div id="alert-successful" class="alert alert-success" role="alert" hidden>
                    <i class="fas fa-check-circle fa-lg"></i> Login successful
                </div>-->
        <div id ="content">
            <div class="amount">
                <div class="amounttext">
                    <label>Are you able to reach this number?</label>
                    <p></p>
                </div>
            </div>
            <div class="counter">
                <button class="moneybutton" onclick="minusAmount(1)">$1</button>
                <button class="moneybutton" onclick="minusAmount(2)">$2</button>
                <button class="moneybutton" onclick="minusAmount(5)">$5</button>
                <button class="moneybutton" onclick="minusAmount(10)">$10</button>
            </div>

        </div>
        <?php
        include "../HeaderFile/footer.php"
        ?>

    </body>

</html>
