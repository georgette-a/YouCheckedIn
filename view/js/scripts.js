const email = document.getElementById('exampleInputEmail1').value;
const password = document.getElementById('exampleInputPassword1');
const form = document.getElementById('login_form ');
const error = document.getElementById('error');

var mailRGEX = /[a-zA-Z]+.[a-zA-Z]+\@ashesi\.edu\.gh/;
var mailResult = mailRGEX.test(uemail);
form.addEventListener('submit', (e) => {
    let messages = [];
    if (mailResult == false) {
        messages.push("Wrong Email Format")


    }



})