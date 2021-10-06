<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include "../HeaderFile/header.php"
        ?>
        <!--<meta charset="UTF-8">-->
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="4pics1word.css" rel="stylesheet">
        <script defer src="4pics1word.js"></script>
        <title>4 pics 1 word</title>
    </head>
    <body>
        <?php
        include "../NavBar/navigationbar.php"
        ?>
        <div class="container">

            <!--            <div id="google_translate_element"></div>
                        <script type="text/javascript">
                            function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                            }
                        </script>
                        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
            <div class="flex-heading">
                <h1 id="title">4 Pic 1 Word</h1>
                <div class="points">
                    <p style="margin: 0 0 0 0;">Points: </p>
                    <p style="margin: 0 0 0 0;" id = "score">0</p>
                </div>
            </div>

            <div id="question-container" class="hide">
                <div class="image-options-grid">
                    <div>
                        <div id="images"></div>
                    </div>
                    <div class="right-items">

                        <button id="hint-btn">hints: 2</button> 
                        <button id="sound1">0</button> &nbsp;
                        <button id="sound2">1</button> &nbsp;
                        <button id="sound3">2</button> &nbsp;
                        <button id="sound4">3</button>
                        <h4 class="question">What is shown in the 4 pictures?</h4>
                        <p id="errorMessage" class="error-message hide">Incorrect, try again!</p>
                        <div id="answer-buttons" class="btn-grid">                       
                            <button id = "option1" class="btn">Answer 1</button> 
                            <button id = "option2" class="btn">Answer 2</button>
                            <button id = "option3" class="btn">Answer 3</button>
                            <button id = "option4" class="btn">Answer 4</button>
                        </div>

                    </div>

                </div>

            </div>
            <div class="custom-modal" id="modal">
                <div class="custom-modal-header">
                    <!--<button data-close-button class ="close-button">&times;</button>-->
                    <img src="images//check.png" style="width:80px;height:80px; ">
                    <div style="display:flex; flex-direction: column; margin: 20px;">
                        <h1 style = "margin: 0 0 0 0">Correct Answer!</h1>
                        <h4 id="selectedOption" style = "margin: 2px 0 0 0"></h4>
                    </div>
                </div>
                <div id="custom-modal-body">
                    <h3 style="text-align: center;">Did you know!</h3>
                    <P id="funfact"></P>
                    <div class="controls">
                        <button id="next-btn" class="next-btn btn">Next question</button>
                        <a href="/index.php" target="_parent">
                            <button id="leaderboard-btn" class="start-btn btn hide">Leader Board</button>
                        </a>

                    </div>
                </div>
            </div>
            <div id="overlay"></div>
            <div class="controls">
                <button id="start-btn" class="start-btn btn">Start</button>
            </div>
        </div>
        <?php
        include "../HeaderFile/footer.php"
        ?>
    </body>
</html>