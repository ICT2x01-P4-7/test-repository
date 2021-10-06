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
        <title>Login Page</title>
        <link rel="stylesheet" href="login.css"/>
        <script defer src="login.js"></script>
        <script>
            $(document).ready(function () {

                // Just to allow user to click continue
                function enableButton() {
                    $(".inputplusicon").css({"border": "3px solid var(--font-one)"});
                    $("#clr-btn").prop("hidden", false);
                    setTimeout(function () {
                        $("#submit").prop("disabled", false);
                    }, 3000);
//                $("#submit").prop("disabled", false); // Delete if the timeout is better
                }
                ;
                // To allow the elderly to press okay
                $("#username").on("click", enableButton);

                // When submit is clicked
                $("#submit").click(function () {
                    let userid = document.querySelector('#username').value;
                    if (userid == "") {
                        $("#alert-error").prop("hidden", false);
                        $(".inputplusicon").css({"border": "3px solid red"});
                    } else {
                        // Verify if login
                        console.log(userid);
//                    $("#alert-successful").prop("hidden", false);
                    }

                });
            });
        </script>
    </head>
    <body>
        <?php
        include "../NavBar/navigationbar.php"
        ?>
        <div id="alert-error" class="alert alert-danger" role="alert" hidden>
            <i class="fas fa-exclamation-circle fa-lg"></i> Username is invalid, please try again! OR click <a href="#" class="alert-link">Register here</a>
        </div>
        <!--        <div id="alert-successful" class="alert alert-success" role="alert" hidden>
                    <i class="fas fa-check-circle fa-lg"></i> Login successful
                </div>-->
        <div id ="content">

            <div id ="content-left">
                <img src="Image.JPG" width="340px">
            </div>
            <div id ="content-right">
                <div id="login-title">
                    <label><h2>Log in to AHMLX</h2></label>
                </div>

                <div class="inputplusicon">
                    <input id="username" placeholder="Username" type="text" autocomplete="off">
                    <i id="clr-btn" class="fas fa-times-circle fa-lg" onclick="document.getElementById('username').value = ''" hidden></i>
                </div>
                <p id="invalidPass" class="hide">Username is invalid, please try again!</p>
                <button id="submit" disabled>Continue</button>
                <span><hr>or<hr></span>
                <a href="register.php">Create a new account</a>
            </div>
        </div>
        <?php
        include "../HeaderFile/footer.php"
        ?>

    </body>

</html>
