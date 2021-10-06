/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * 1. change levels to be dynamic and not hardcode
 * 2. add pop up box for showing whether answer is correct
 * correct message: well done, you are correct
 * wrong message: sorry wrong answer, let's try again!
 * 3. change logic to have user try until correct answer
 * 4. delete the wrong answer instead of coloring it red
 * 5. find legit pics and answers
 * 6. add score at the top
 *  correct answer = +10
 *  wrong answer = -1
 */
speechSynthesis.speak(new SpeechSynthesisUtterance("Welcome to 4 Pic 1 Word game!"));

const startButton = document.getElementById('start-btn');
const nextButton = document.getElementById('next-btn');
const hintButton = document.getElementById('hint-btn');
const leaderBoardButton = document.getElementById('leaderboard-btn');
const questionContainerElement = document.getElementById('question-container');
const imageElement = document.getElementById('images');
const answerButtonsElement = document.getElementById('answer-buttons');
const openModalButtons = document.querySelectorAll('[data-modal-target]');
const closeModalButtons = document.querySelectorAll('[data-close-button]');
const overlay = document.getElementById('overlay');
const modalBody = document.getElementById('modal-body');
const modalHeader = document.getElementById('modal-header');
const btnArray = document.getElementsByClassName('btn123');
const overallScore = document.getElementById('score');
const selectedAnswer = document.getElementById('selectedOption');
const funFact = document.getElementById('funfact');
const errorMessage = document.getElementById('errorMessage');
let score = 0;
let noHints = 2;
let correctOption = false;
let wrongOption = false;
let btnRemove = false;
let shuffledQuestions, currentQuestionIndex;

var correctSound = new Audio("/Audio/correctSound.wav");
var wrongSound = new Audio("/Audio/wrongSound.wav");

// retrieve json with fetch api from db.

//async function getQuestion() {
//    const response = await fetch('https://ahmlx-springboot.herokuapp.com/getQuestions', {
//        method: 'POST',
//        headers: {
//            'Content-Type': 'application/json',
//        }});
//    const data = await response.json();
//    return data;
//}
//
//getQuestion().then(data => {
//    questions = data;
//    console.log(questions);
//    hintButton.addEventListener('click', giveHint);
//    startButton.addEventListener('click', startGame);
//    nextButton.addEventListener('click', () => {
//        currentQuestionIndex++;
//        setNextQuestion();
//    })
//});

hintButton.addEventListener('click', giveHint);
startButton.addEventListener('click', startGame);

nextButton.addEventListener('click', () => {
    overallScore.innerHTML = score;
    currentQuestionIndex++;
    setNextQuestion();
    closeModal(modal);
})

function giveHint() {
    btnRemove = false;
    removeWrongAns(shuffledQuestions[currentQuestionIndex]);
    if (noHints == 0) {
        hintButton.disabled = true;
    }
}

// remove function for hint button
function removeWrongAns(question) {
    Array.from(answerButtonsElement.children).forEach(button => {
        question.answers.forEach(answer => {
            if (btnRemove) {
                return;
            }
            if (noHints >= 1 && answer.correct == false) {
                if (button.dataset.text === answer.text) {
                    button.remove();
                    noHints -= 1;
                    hits += 1;
                    btnRemove = true;
                    hintButton.innerText = "hints: " + noHints;
                }
            }
        })
    })
}

/* function to start game.
 * 1. Randomize questions,
 * 2. set questions
 * 
 */
function startGame() {
    noHints = 2;
    hintButton.disabled = false;
    startButton.classList.add('hide');
    shuffledQuestions = questions.sort(() => Math.random() - .5);
    currentQuestionIndex = 0;
    questionContainerElement.classList.remove('hide');
    setNextQuestion();


}

function setNextQuestion() {
    resetState();
    showQuestion(shuffledQuestions[currentQuestionIndex]);
}

function showQuestion(question) {
    funFact.innerText = question.funFact;
    // for loop to retrieve and populate question from json data
    question.question.forEach(question => {
        // populate the 4 pics 
        const image = document.createElement('img');
        image.src = 'images\\' + question;
        image.dataset.modalTarget = '#modal';
        image.classList.add('rounded-border');
        imageElement.appendChild(image);
        // modal to enlarge the 4 pics 
        image.addEventListener('click', () => {
            const enlargedImage = document.createElement('img');
            enlargedImage.src = 'images\\large_' + question;
            enlargedImage.classList.add('center');
            const modal = document.querySelector(image.dataset.modalTarget);
            openModal(modal);
            modalBody.appendChild(enlargedImage);
        })
    })
    // populate the answers to the button
    question.answers.forEach(answer => {
        const button = document.createElement('button');
        button.innerText = answer.text;
        button.classList.add('btn123');
        button.dataset.text = answer.text;
        button.dataset.correct = answer.correct;
        button.addEventListener('click', selectAnswer);
        answerButtonsElement.appendChild(button);

//        speechSynthesis.speak(new SpeechSynthesisUtterance(answerButtonsElement.childElementCount + ": " + button.dataset.text));
    })
}

// for restart and start function
function resetState() {
    hits = 0;
    noHints = 2;
    hintButton.disabled = false;
    hintButton.innerText = "hints: 2";
    errorMessage.classList.add('hide');
    while (imageElement.firstChild) {
        imageElement.removeChild(imageElement.firstChild);
    }
    while (answerButtonsElement.firstChild) {
        answerButtonsElement.removeChild(answerButtonsElement.firstChild);
    }
}


function selectAnswer(e) {
    correctOption = false;
    wrongOption = false;
    const selectedButton = e.target;
    const correct = selectedButton.dataset.correct;
    // hide next button and show leaderboard button when reach the last question
    if (shuffledQuestions.length == currentQuestionIndex + 1 && selectedButton.dataset.correct == "true") {
        nextButton.classList.add('hide');
        leaderBoardButton.classList.remove('hide');
    }
//    setStatusClass(document.body, correct);
    setStatusClass(selectedButton, selectedButton.dataset.correct);
}

// check whether button pressed is correct or false answer. 
function setStatusClass(element, correct) {
    clearStatusClass(element);
    if (correct == "true") {
        correctSound.play();
        score += 100;
        correctOption = true;
        element.classList.add('correct');
        hintButton.disabled = true;
        element.disabled = true;
        // populate the modal for fun facts
        selectedAnswer.innerHTML = "You selected: " + element.innerHTML;
        element.dataset.modalTarget = '#modal';
        const modal = document.querySelector(element.dataset.modalTarget);
//        speechSynthesis.speak(new SpeechSynthesisUtterance("Well done!"));
//        speechSynthesis.speak(new SpeechSynthesisUtterance(selectedAnswer.innerHTML));
//        speechSynthesis.speak(new SpeechSynthesisUtterance("Did you know? " + funFact.innerText));
        openModal(modal);
//        modalHeader.appendChild(selectedAnswer);
//        modalBody.appendChild(funFact);
//        speechSynthesis.speak(new SpeechSynthesisUtterance(modal));
    } else if (correct == "false") {
        wrongSound.play();
        score -= 20;
        errorMessage.classList.remove('hide');
        wrongOption = true;
        element.classList.add('wrong');
        element.disabled = true;
//        speechSynthesis.speak(new SpeechSynthesisUtterance("Let's try again!"));

//        if (element != document.body) {
//            const message = document.createElement('p');
//            message.innerText = "Sorry! Lets try again!";
//            element.dataset.modalTarget = '#modal';
//            const modal = document.querySelector(element.dataset.modalTarget);
//            openModal(modal);
//            modalBody.appendChild(message);
//            setTimeout(function () {
//                closeModal(modal)
//            }, 2000);
//        }
    }

}

// remove special effects of the button and any disabled buttons for next question.
function clearStatusClass(element) {
    element.classList.remove('correct');
    element.classList.remove('wrong');
    Array.from(answerButtonsElement).forEach(button => {
        button.disabled = false;
    })
}

//overlay.addEventListener('click', () => {
//    const modals = document.querySelectorAll('.modal.active');
//    modals.forEach(modal => {
//        closeModal(modal);
//    })
//})

closeModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.modal');
        closeModal(modal);
    })
})

function openModal(modal) {
    if (modal == null)
        return;
    modal.classList.add('active');
    overlay.classList.add('active');
}
function closeModal(modal) {
    if (modal == null)
        return;
//    modalBody.removeChild(modalBody.firstChild);
//    modalHeader.removeChild(modalHeader.firstChild);
    modal.classList.remove('active');
    overlay.classList.remove('active');
}

// audio function for the buttons
if ('speechSynthesis' in window)
    with (speechSynthesis) {

        var firstSound = document.querySelector('#sound1');
        var secondSound = document.querySelector('#sound2');
        var thirdSound = document.querySelector('#sound3');
        var forthSound = document.querySelector('#sound4');
        firstSound.addEventListener('click', onClickPlay);
        secondSound.addEventListener('click', onClickPlay);
        thirdSound.addEventListener('click', onClickPlay);
        forthSound.addEventListener('click', onClickPlay);


        function onClickPlay(e) {
            const playEle = e.target;
            utterance = new SpeechSynthesisUtterance();
            utterance.voice = getVoices()[3];
            utterance.text = answerButtonsElement.children[playEle.innerText].innerText;
            // voice approved: 6,7,8,9,22, 23(cantonese), 
            speak(utterance);
        }
//        if (correctOption == true) {
//            utterance.text = "Well Done!";
//            speak(utterance);
//        }
//        if (wrongOption == true) {
//            utterance.text = "Sorry! Let's try again!";
//            speak(utterance);
//        }
    }
else { /* speech synthesis not supported */
    msg = document.createElement('h5');
    msg.textContent = "Detected no support for Speech Synthesis";
    msg.style.textAlign = 'center';
    msg.style.backgroundColor = 'red';
    msg.style.color = 'white';
    msg.style.marginTop = msg.style.marginBottom = 0;
    document.body.insertBefore(msg, document.querySelector('div'));
}

var questions = [
    {
        "question": [
            "tea_black_tea.jpg",
            "tea_tea_leaf.jpg",
            "tea_letter_T.png",
            "tea_teh_c.jpg"
        ],
        "answers": [
            {
                "text": "Tea",
                "correct": true
            },
            {
                "text": "Coffee",
                "correct": false
            },
            {
                "text": "Milo",
                "correct": false
            },
            {
                "text": "Orange Juice",
                "correct": false
            }
        ],
        "funFact": "Drinking tea can calm your nerves and make you focus better!"
    },
    {
        "question": [
            "merlion_left.jpg",
            "merlion_eyes.jpg",
            "merlion_face.jpg",
            "merlion_right.jpg"
        ],
        "answers": [
            {
                "text": "Lion",
                "correct": false
            },
            {
                "text": "Merlion",
                "correct": true
            },
            {
                "text": "Prawn",
                "correct": false
            },
            {
                "text": "Mermaid",
                "correct": false
            }
        ],
        "funFact": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
    },
    {
        "question": [
            "singapore_new.jpg",
            "singapore_old.jpeg",
            "singapore_old2.jpg",
            "singapore_river.png"
        ],
        "answers": [
            {
                "text": "Malaysia",
                "correct": false
            },
            {
                "text": "China",
                "correct": false
            },
            {
                "text": "India",
                "correct": false
            },
            {
                "text": "Singapore",
                "correct": true
            }
        ],
        "funFact": "In singapore, there is a team of Tech Heroes who helps the elderly. They are called AHMLX."
    },
    {
        "question": [
            "police_car.jpg",
            "police_old.png",
            "police_logo.jpg",
            "police_new.jpg"
        ],
        "answers": [
            {
                "text": "Nurse",
                "correct": false
            },
            {
                "text": "Doctor",
                "correct": false
            },
            {
                "text": "Firefighter",
                "correct": false
            },
            {
                "text": "Police Officer",
                "correct": true
            }
        ],
        "funFact": "In the olden days, police officers wear short pants to run faster."
    }
        
];
