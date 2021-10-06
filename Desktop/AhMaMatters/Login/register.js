/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



const submitButton = document.getElementById('submit');
const invalidPass = document.getElementById('invalidPass');


submitButton.addEventListener('click', register);


function register() {
    const name = document.getElementById('name').value;
    const username = document.getElementById('username').value;
    var userProfile;
    const userBody = {
        "username": username,
        "name": name
    }
    console.log(userBody);
    async function getUsername() {
        const response = await fetch('https://ahmlx-springboot.herokuapp.com/addUsername', {
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
        if (username != "" && userProfile.message == "Ok") {
            console.log("Success!");
            window.location.replace("/Login/login.php");
            window.alert("Successfully created an account!");
        } else if (userProfile.message == "Exists") {
            window.alert("The username already exist!");
        } else {
            window.alert("Fail to create an account! Please try again.");
        }
    });
}