var password = document.getElementById('password');
var secondPassword = document.getElementById('secondpassword');
var form = document.getElementById('form');
var passwordInput = document.getElementById("passwordInput")

var newElement = document.createElement("p");
var newText = document.createTextNode("Пароли не совпадают");
newElement.appendChild(newText);

newElement.className = "invalidPass";


function validatePassword() {
    if (form.reportValidity()) {
        if (password !== secondPassword) {
            passwordInput.appendChild(newElement)
        } else {
            form.submit();
        }
    }
}