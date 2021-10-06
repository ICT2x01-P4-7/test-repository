
<!DOCTYPE html>
<html>
    <body>
        <div class="container">
            <header>
                <h1>Card Matching</h1>
            </header>
            <section class="score-panel">
                <h3>Score Panel</h3>
                <div class="timer-container">
                    <span class="timer"><i class="fa fa-hourglass-start"></i>Timer: 00:00</span>
                </div>
                <div class="reset">
                    <button class="btn reset-btn">Reset<i class="fa fa-repeat"></i></button>
                </div>
                <section>
                    <!-- Modal -->
                    <section class="win-game-modal">
                        <div id="modal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Congratulation!</h2>
                                <p>You have won the game and found all 4 pairs of cards</p>
                                <button class="btn play-again-btn">Play Again?</button>
                            </div>
                        </div>
                    </section>
                    <ul class="deck">

                    </ul>
                </section>
            </section>
        </div>  
    </body>
    <style>
        *{
            margin: 0;
            padding: 0;
          
        }
        *,*::after,*::before{
            box-sizing: inherit;
            
        }
        html{
            font-family: "Open Sans", sans-serif;
            font-size: 62.5%;
            letter-spacing: 1.5px;
            margin: 0;
            text-align: center;
        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top:0.5em;
        }
        ul > li{
            list-style: none;
        }
        .card,.reset-btn{
            cursor: pointer;
        }
        .btn{
            border-radius: 1em;
            border: none;
            color:#fff;
            box-shadow: 5px 2px 20px 0 rgba(46,61,73,0.5);
            padding: 0.8em;
        }
        h1{
            font-size: 3em;
            font-weight: 400;
            
        }
        h2{
            font-size: 2.5em;
            font-weight: 600;
        }
        p{
            font-size: 1.6em;
            
        }
        h3{
            font-weight: 400;
        }
        .score-panel{
            font-size: 1.4em;
            padding: 1em 0 2em;
            
        }
        .star-rating > li{
            display: inline-block;
            padding: 0.5em;
            
        }
        .moves-counter{
            padding: 0.5em;
        }
        .reset-btn{
            background: #000;
            margin-bottom: 1.5em;
        }
        .timer-container{
            background: #fff;
            border-radius: 0.5em;
            color: #000;
            margin: 0.5em;
            padding: 0.5em;
        }
        .timer{
            font-size: 1em;
        }
        .modal{
            display:none;
            position: fixed;
            z-index: 99;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(46,61,73);
            background-color: rgba(46,61,73,0.6);
        }
        .modal-content{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            background-color: #fff;
            margin: 5% auto;
            border: 0.8em solid #fc4;
            padding-right: 2em;
            width: 80%;
        }
        .close:hover,.close:focus{
            color: #5cf;
            text-decoration: none;
            cursor: pointer;
        }

        p.stats{
            font-weight: 600;
        }
        p.stats:last-child{
            margin-bottom: 1em;
        }
        .play-again-btn{
            background: #28e;
            margin-bottom: 1em;
        }
        .deck{
            background: linear-gradient(to bottom,#5cf,#28e);
            border-radius: 1.5em;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            height: 35em;
            margin-bottom: 6em;
            padding: 0.5em;
            max-width: 80em;
        }
        .deck,.card{
            box-shadow: 5px,2px,20px 0 rgba(46,61,73,0.5);
        }
        .card{
            background: #fc4;
            border-radius: 0.5em;
            min-height: 12em;
            min-width: 10em;
            margin-left: 0.5em;
            margin-right: 0.5em;
        }
        .card img{
            margin-top: 2em;
        }
        img{
            user-select:none;
            width: 6em;
            
        }
        .deck img{
            visibility: hidden;
        }
        .deck .card.flip{
            background: #fff;
            cursor: default;
            transform: rotateY(180deg);
            transition: transform 0.3s linear;
            pointer-events: none;
        }
        .flip img{
            background: #fff;
            visibility: visible;
        }
        .deck .card.match{
            background: #39d;
            visibility: visible;
            cursor: default;
            animation: pulse 1s;
        }
        .match img{
            background:#39d;
        }
        @keyframes pulse{
            0%{
                transform:scale(1);
            }
            80%{
                transform:scale(1.1);
            }
            100%{
                transform:scale(1);
            }
        }
    </style>
    <script>

        // Array of deck of card images
        const deskCards = ["currypuff.jpg","kayatoast.jpg","nonyakueh.png","MinJiangKieh.jpg","currypuff.jpg","kayatoast.jpg","nonyakueh.png","MinJiangKieh.jpg"];
        // Global Arrays
        // Access the <ul> with class of .deck
        const deck = document.querySelector(".deck");
        // Create an empty array to store the opened cards
        let opened = [];
        // Create an empty array to store the matched cards
        let matched = [];        
        // Access the modal
        const modal = document.getElementById("modal");
        // Access the reset button
        const reset = document.querySelector(".reset-btn");
        // Access the play again button
        const playAgain = document.querySelector(".play-again-btn");
        // select the class move-counter and change it's HTML
        const movesCount = document.querySelector(".moves-counter");
        // Create variable for moves counter, start the count at zero
        let moves = 0;
        const timerCounter = document.querySelector(".timer");
        let time = 0;
        let minutes = 0;
        let seconds = 0;
        let timeStart = false;

    // Random placement of cards
    function shuffle(array){
            let currentIndex = array.length,temporaryValue,randomIndex;
            while (currentIndex !==0){
                randomIndex = Math.floor(Math.random()* currentIndex);
                currentIndex -=1;
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }
            return array;
        }
    function startGame(){
        // Invoke shuffle function and store in variable
        const shuffledDeck = shuffle(deskCards);
        
        // Iterate over deck of cards array
        for (let i=0;i<shuffledDeck.length;i++){
            // Create the <li> tag
            const liTag = document.createElement("LI");
            // Give <li> class of card
            liTag.classList.add('card');
            //create the <img> tags
            const addImage = document.createElement("IMG");

            //Append <img> to <li>
            liTag.appendChild(addImage);

            //Set the img src path with the shuffled deck
            addImage.setAttribute("src","img/" + shuffledDeck[i]);
            
            // Add an alt tag to the image
           addImage.classList.add(shuffledDeck[i].replace('.png',''));
           addImage.setAttribute("alt",shuffledDeck[i].replace('.png',''));
           // Update the new <li> to the deck <ul>
            deck.appendChild(liTag);
        }
    }
    startGame();
    function removeCard(){
        while(deck.hasChildNodes()){
            deck.removeChild(deck.firstChild);
        }
    }
    function timer(){
        time = setInterval(function(){
            seconds++;
            if (seconds === 60){
                minutes++;
                seconds = 0;
            }
            timerCounter.innerHTML = "<i class='fa fa-hourglass-start'></i>"+ " Timer: "+ minutes+"Mins"+ seconds + "Secs";
            
        },1000)
    }
    function stopTime(){
        clearInterval(time);
    }
    function resetEverything(){
        stopTime();
        timeStart = false;
        seconds = 0;
        minutes = 0;
        timerCounter.innerHTML = "<i class='fa fa-hourglass-start'></i>"+ " Timer: 00:00";

        //Reset moves count and reset its inner HTML
        moves = 0;
        movesCount.innerHTML = 0;
        matched=[];
        opened = [];
        // Clear the deck
        removeCard();
        // Create a new deck
        startGame();
    
    }
    function movesCounter(){
        movesCount.innerHTML ++;
        moves ++;
    }

    function compareTwo(){
        // When there are 2 cards in the opened array
        var firstCard = opened[0].className;
        var secondCard = opened[1].className;
        if (firstCard.charAt(firstCard.length-1)=== "1"){
            opened[0].classList.remove(opened[0].className);
            opened[0].classList.add(firstCard.replace('1',''));
            console.log("Change " + firstCard.replace('1',''));
        }

        
        if(secondCard.charAt(secondCard.length-1)=== "1"){
            opened[1].classList.remove(opened[1].className);
            opened[1].classList.add(secondCard.replace('1',''));
            console.log("Change "+ secondCard.replace('1',''));
        }
        console.log(opened[0].className + " First Card");
        console.log(opened[1].className + "Second Card");
        if (opened[0].classList.contains(opened[1].className)){
           
            match();
        }
        else{
            

            noMatch();
        }
    }
    function match(){
        setTimeout(function(){
            opened[0].parentElement.classList.add("match");
            opened[1].parentElement.classList.add("match");
            matched.push(...opened);
            document.body.style.pointerEvents = "auto";
            winGame();
            opened = [];},600);
        movesCounter();
    }
    function noMatch(){
        setTimeout(function(){
            opened[0].parentElement.classList.remove("flip");
            opened[1].parentElement.classList.remove("flip");
            document.body.style.pointerEvents = "auto";
            opened = [];
        },700);
        movesCounter();
    }
    function AddStats(){
        const stats = document.querySelector(".modal-content");
        for (let i = 1; i <=3; i++){
            const statsElement = document.createElement("p");
            statsElement.classList.add("stats");
            stats.appendChild(statsElement);   
        }
        let p = stats.querySelectorAll("p.stats");
        p[0].innerHTML = "Time to complete: "+ minutes + " Minutes and "+ seconds +" Seconds";
        p[1].innerHTML = "Moves Taken: "+moves;
    }
    function displayModal(){
        const modalClose = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
        modalClose.onclick = function(){
            modal.style.display = "none";
        };
        window.onclick = function(event){
            if(event.target === modal){
                modal.style.display = "none";
            }
        };
    }
    function winGame(){
        if(matched.length === 8){
            stopTime();
            AddStats();
            displayModal();
        }
    }
    deck.addEventListener("click",function(evt){
        if(evt.target.nodeName === "LI"){
            console.log(evt.target.nodeName+ " was clicked");
            if(timeStart === false){
                timeStart = true;
                timer();
                
            }
            flipCard();
        }
        function flipCard(){
            evt.target.classList.add("flip");
            addToOpened();
        }
        function addToOpened(){
            if(opened.length ===0 || opened.length === 1){
                opened.push(evt.target.firstElementChild);
            }
            if(opened.length === 2){
                compareTwo();
            }
        }
    });
    reset.addEventListener('click',resetEverything);
    playAgain.addEventListener('click',function(){
        modal.style.display = "none";
        resetEverything();
    });
    </script>
</html>

