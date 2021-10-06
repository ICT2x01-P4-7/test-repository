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
        <link rel="stylesheet" href="register.css"/>
        <script defer src="register.js"></script>
        <script>
            $(document).ready(function () {               
                
                // Just to allow user to click continue
                function enableName() {
                    $(".usernameinput").css({"border": "1px solid var(--font-one)"});
                    $(".nameinput").css({"border": "3px solid var(--font-one)"});
                    $("#clr-btn").prop("hidden", true);
                    $("#clr-name").prop("hidden", false);
                    setTimeout(function () {
                        $("#submit").prop("disabled", false);
                    }, 3000);
//                $("#submit").prop("disabled", false); // Delete if the timeout is better
                };
                
                // Just to allow user to click continue
                function enableUsername() {
                    $(".nameinput").css({"border": "1px solid var(--font-one)"});
                    $(".usernameinput").css({"border": "3px solid var(--font-one)"});
                    $("#clr-btn").prop("hidden", false);
                    $("#clr-name").prop("hidden", true);
                    setTimeout(function () {
                        $("#submit").prop("disabled", false);
                    }, 3000);
//                $("#submit").prop("disabled", false); // Delete if the timeout is better
                };
                
                // To allow the elderly to press okay
                $("#name").on("click", enableName);
                $("#username").on("click", enableUsername);

                // When submit is clicked
                $("#submit").click(function () {
                    let user = document.querySelector('#name').value;
                    let userid = document.querySelector('#username').value;
                    if (user == "") {
                        $("#alert-error").prop("hidden", false);
                        $(".nameinput").css({"border": "3px solid red"});
                    }else if (userid == "") {
                        $("#alert-error").prop("hidden", false);
                        $(".usernameinput").css({"border": "3px solid red"});
                    } else {
                        // Verify if login
                        console.log(user);
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
            <div id ="content-right">
                <div id="login-title">
                    <label><h2>Create new account</h2></label>
                </div>
                
                <div class="inputplusicon nameinput">
                    <input id="name" placeholder="Name" type="text" autocomplete="off">
                    <i id="clr-name" class="fas fa-times-circle fa-lg" onclick="document.getElementById('name').value = ''" hidden></i>
                </div>
                <div class="inputplusicon usernameinput">
                    <input id="username" placeholder="Username (Example: Susan1958)" type="text" autocomplete="off">
                    <i id="clr-btn" class="fas fa-times-circle fa-lg" onclick="document.getElementById('username').value = ''" hidden></i>
                </div>
                <button id="submit" disabled>Continue</button>
                <span><hr>or<hr></span>
                <a href="login.php">Log in</a>
            </div>
            <div id ="content-left">
                <img src="Image.JPG" width="340px">
            </div>
        </div>
        <?php 
        include "../HeaderFile/footer.php"
        ?>
        
    </body>

</html>
