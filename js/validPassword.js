password = document.querySelector("input[name='password']");
secondPassword = document.querySelector("input[name='secondpassword']");
form = document.querySelector('#form');
passwordInput = document.querySelector("#passwordInput")
span = document.querySelector('.span');

function validatePassword() {
    if (form.reportValidity()) {
        if (password.value !== secondPassword.value) {
            notValid(passwordInput, span, "Пароли не совпадают")
        } else {
            form.submit();
        }
    }
}

function notValid(input, element, message) {
    element.classList.add('req');
    element.innerHTML = message;
}

function valid(input, element) {
    element.classList.remove('req');
    element.innerHTML = '';
}
