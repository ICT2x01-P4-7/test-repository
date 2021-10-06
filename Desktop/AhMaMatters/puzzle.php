<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/src/favicon.ico" type="image/icon type" alt="Heart by Knockout Prezo from the Noun Project">
        <title>Jigsaw Puzzle</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/trontastic/jquery-ui.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="jquery.ui.touch-punch.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="custom.css"/>
        <script>
            $(document).ready(function () {

                var timelimit = 600;
                var intervalTime, timeEnd;
                var allowReset;
                var gameStart = false;
                var widthDisplay = $(window).width();
                var hintArray = [];
//                console.log(widthDisplay)

                var pieces = createPieces(true);
                $("#puzzleContainer").html(pieces);

                function countDown(seconds) {
                    // Set the date we're counting down to
//                    var countDownDate = new Date().getTime() + (seconds * 1000);
                    var countDownDate = new Date().getTime();

                    // Update the count down every 1 second
                    intervalTime = setInterval(function () {

                        // Get today's date and time
                        var now = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;
                        var distance = now - countDownDate;

                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        $("#puzzleTimer").text(minutes + "m " + seconds + "s ");

                        // If the count down is over, write some text 
                        if (distance < 0) {
                            clearInterval(intervalTime);
                            $("#puzzleTimer").text("Time's up");
                        }
                    }, 500);
                }
                ;

                $("#btnStart").click(function () {
                    gameStart = true;
                    countDown(timelimit);
                    var pieces = $("#puzzleContainer div");

                    pieces.each(function () {
                        var leftPosition = Math.floor(Math.random() * (widthDisplay - 110)) + "px";
                        var topPosition = Math.floor(Math.random() * 290) + "px";
                        $(this).addClass("draggablePiece").css({
                            position: "absolute",
                            left: leftPosition,
                            top: topPosition,
                        })
                        $("#pieceContainer").append($(this))
                    });
                    var emptyString = createPieces(false);
                    $("#puzzleContainer").html(emptyString);
                    $(this).hide();
                    $("#btnReset").show();

                    implementLogic()
                });

                $("#btnHint").click(function () {
                    if (hintArray.length == 10) {
                        console.log("No more hints")
                        $("#btnHint").hide();
                    }else if(!gameStart){
                        console.log("Start first")
                    }else {
                        var randomHint = Math.floor(Math.random() * 16);
                        while (hintArray.includes(randomHint)) {
                            randomHint = Math.floor(Math.random() * 16);
                        }
                        hintArray.push(randomHint)
                    }

                    var test = $('[data-order="' + randomHint + '"]');
                    test.detach();
                    $('[data-position="' + (randomHint) + '"]').append(test);

                    test.css({"position": "relative", "left": "0px", "top": "0px"});
                    test.parent().addClass("piecePresent");
                    test.addClass("droppedPiece");
                });

                function createPieces(show) {
                    var rows = 4, columns = 4;
                    var pieces = "";

                    for (var i = 0, top = 0, order = 0; i < rows; i++, top -= 100) {
                        for (var j = 0, left = 0; j < columns; j++, left -= 100, order++) {
                            if (show) {
                                pieces += '<div style="background-position: ' + left + 'px ' + top + 'px;" class="piece" data-order=' + order + '></div>';
                            } else {
                                pieces += '<div style="background-image:none;" class="piece droppableSpace" data-position=' + order + '></div>';
                            }
                        }
                    }
                    allowReset = false;
                    return pieces;
                }
                ;

                $("#btnReset").click(function () {
                    gameStart = false;
                    hintArray = [];
                    $("#btnHint").show();
                    clearInterval(intervalTime);
                    $("#puzzleTimer").text("Press Start");

                    var newPieces = createPieces(true);
                    $("#puzzleContainer").html(newPieces);
                    $(this).hide();
                    $("#btnStart").show();
                    $("#pieceContainer").empty();
                });
                
                $("#homeScreen").click(function () {
                    window.location.href = "index.php";
                });

                function checkIfPuzzleSolved() {
                    if ($("#puzzleContainer .droppedPiece").length != 16) {
                        return false;
                    }
                    for (var k = 0; k < 16; k++) {
                        var item = $("#puzzleContainer .droppedPiece:eq(" + k + ")");
                        var order = item.data("order");

                        if (k != order) {
                            $("#pieceContainer").text("Ouch, Try Again");
                            return false;
                        }
                    }
                    allowReset = true;
                    $("#pieceContainer").text("This is a merlion!");
                    return true;
                }
                ;

                function implementLogic() {

                    $(".draggablePiece").draggable({
                        revert: "invalid",
                        start: function () {
                            if ($(this).hasClass("droppedPiece")) {
                                $(this).removeClass("droppedPiece");
                                $(this).parent().removeClass("piecePresent");
                            }
                        }
                    });
                    $(".droppableSpace").droppable({
                        drop: function (event, ui) {
                            var draggableElement = ui.draggable;
                            var droppedOn = $(this);
                            droppedOn.addClass("piecePresent");
                            $(draggableElement).addClass("droppedPiece").css({
                                top: 0, left: 0, position: "relative"
                            }).appendTo(droppedOn);

                            checkIfPuzzleSolved();
                        }
                    });

                    // Get highlight
                    var hoverClass = $(".droppableSpace").droppable("option", "hoverClass");
                    // Setter
                    $(".droppableSpace").droppable("option", "hoverClass", "ui-state-highlight");

                    // Get accept
                    var accept = $(".droppableSpace").droppable("option", "accept");

                    // Setter
                    $(".droppableSpace").droppable("option", "accept", myFunc);
                }
                ;

                function myFunc() {
                    return !$(this).hasClass("piecePresent");
                }
                ;
            });
        </script>
    </head>
    <body>
        <div id ="container">
            <!-- As a heading -->
            <nav class="navbar navbar-dark bg-dark">
                <span id="homeScreen" class="navbar-brand mb-0 h1"><i class="far fa-arrow-alt-circle-left"></i> Back to homescreen</span>
            </nav>
            <div class="content">
                <div class="left-section">
                    <div id="puzzleContainer"></div>
                </div>
                <div class="right-section">
                    <div id="puzzleTimer">Press Start</div>
                    <!--Possible to change to one button-->
                    <!--<button></button>-->
                    <ul id="buttons">
                        <li><button class="btn-success" id="btnStart">Start</button></li>
                        <li><button class="btn-danger" id="btnReset">Reset</button></li>
                        <li><button class="btn-dark" id="btnHint">Hint</button></li>
                    </ul>

                    <p class="preview">solution preview image</p>
                    <div><img class="image" src="/src/merlion.jpg" width="200" height="200"></div>
                </div>
            </div>
            <div id="pieceContainer"></div>


        </div>

        <?php
// put your code here
        ?>
        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
    </body>
</html>
