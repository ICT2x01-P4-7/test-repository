/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// to ping the springboot app
setInterval(function () {
    fetch('https://ahmlx-springboot.herokuapp.com/hello')
            .then(response => response.json())
            .then(data => console.log(data));
}, 300000);

const submitButton = document.getElementById('submit');
const invalidPass = document.getElementById('invalidPass');


submitButton.addEventListener('click', login);


function login() {
    const username = document.getElementById('username').value;
    var userProfile;
    const userBody = {
        "username": username
    }
    console.log(userBody);
    async function getUsername() {
        const response = await fetch('https://ahmlx-springboot.herokuapp.com/getUsername', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(userBody)});
        var data;
        try {
            data = await response.json();
        } catch (err) {
            data = "";
        }
        return data;
    }

    getUsername().then(data => {
        console.log(data)
        userProfile = data;
        if (userProfile.username == username) {
            console.log("Success!");
            invalidPass.classList.add('hide');
            sessionStorage.setItem('userProfile', JSON.stringify(userProfile));
            window.location.replace("/index.php");
        } else {
            invalidPass.classList.remove('hide');
        }
    });
    console.log(userProfile);
}