<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Coloring Game</title>
        <style>
            html,
            body { height: 100%;
            }

            #imagecontainer{
                height:100%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap:wrap;
            }

            #imagetitle{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 30px;
                font-weight: bold;
                text-align:center;
                background-image:linear-gradient(to bottom right, purple, yellow);
                -webkit-background-clip: text;
                color:transparent;
            }

            #imagelocation{
                width: 1400px;
                height: 800px;
                text-align: center;
            }

            #storedcolor{
                width:1400px;
                height: 200px;
                display:flex;
                justify-content: space-between;
            }
            
            #changeImage{
                margin-top:20px;
                background:black;
                color:white;
                width:200px;
                height:40px;
                line-height:40px;
                text-align:center;
            }

            .palette{
                width:1003px;
                height:203px;
                border:1px solid black;

            }

            .colors{
                width:100px;
                height:100px;
                float:left;
            }

            .colortemp{
                border-radius: 50%;
                width:100px;
                height:100px;

                border:5px solid black;
            }

        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            $(document).ready(function (e) {
                var selectedColor = ""
                var chosenColours = ["#FFFFFF", "#C0C0C0", "#808080", "#000000", "#FFA500", "#A52A2A", "#800000", "#008000", "#808000", "#93FFE8",
                    "#FF0000", "#00FFFF", "#0000FF", "#00008B", "#ADD8E6", "#800080", "#FFFF00", "#00FF00", "#FF00FF", "#FFC0CB"]

                var rows = 4, columns = 5;
                var colors = "";

                for (var i = 0, top = 0, order = 0; i < rows; i++, top -= 50) {
                    for (var j = 0, left = 0; j < columns; j++, left -= 40, order++) {
                        colors += '<div style="background-position: ' + left + 'px ' + top + 'px; background-color: ' + chosenColours[order] + ';" class="colors" data-order=' + order + '></div>';
                    }
                }
                $(".palette").html(colors);

//                $('#imagelocation').click(function (e) {
//                    var posX = $(this).position().left, posY = $(this).position().top;
//                    console.log((e.pageX - posX) + ' , ' + (e.pageY - posY));
//                });

                $('.colors').click(function () {
                    selectedColor = chosenColours[$(this).attr("data-order")]
                    console.log(selectedColor)
                    $(".colortemp").css({"background": selectedColor});
                });

                function changeColor(test) {
                    console.log("hi")
                    $(this).fill(selectedColor);
                }
                ;

                $('path').click(function () {
                    console.log($(this))
                    $(this).css({"fill": selectedColor});
                });

                
                $('#changeImage').click(function () {
                    generateMap ("src/park.svg")
                });
                
                function generateMap (image){
                    $('#imagelocation').load(image, function () {
                    $("path").click(function (event) {
                        $(this).css({"fill": selectedColor});
                    });
                });
                }

                generateMap("src/flower.svg")

            });
        </script>

        <script defer src="colorscript.js"></script>
    </head>
    <body>
        <div id="imagecontainer">
            <div id="imagetitle">Coloring Game</div>
            
            <div id="imagelocation"></div> 
            <div id='storedcolor'>
                    <div class="palette"></div>
                    <div class="colortemp"></div>
                </div>
            <div id="changeImage">Change Image</div>
        </div>


        <?php
        // put your code here
        ?>
    </body>
</html>
