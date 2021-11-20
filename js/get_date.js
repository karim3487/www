company = document.getElementById('company_name');
interval = document.getElementById('interval');
numberOfRecords = document.getElementById('numberOfRecords');
date = document.getElementById('date');


date.valueAsDate = new Date();

$.get('https://sedelkin.ru/api/security_list', function (data) {
    const items = Object.values(data['data']);
    for (let tt in items) {
        let opt = document.createElement('option');
        opt.value = items[tt]['secid'];
        opt.textContent = items[tt]['title'];
        company.appendChild(opt);
    }
});

$.get('https://sedelkin.ru/api/interval', function (data) {
    const items = Object.values(data['data']);
    for (let tt in items) {
        let opt = document.createElement('option');
        opt.value = items[tt]['value'];
        opt.textContent = items[tt]['title'];
        interval.appendChild(opt);
    }
});

// проверка: Загружен ли документ
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    form.addEventListener('submit', formSend);

    async function formSend(e) {
        e.preventDefault();

        let error = validateForm(form);

        if (error !== 0) {
            alert("Введите правильные значения!")
        } else {
            let params = {
                app_key: 'lpDRhW4f%5Bj|i8mB~BjlCD#Ve6wAi',
                secid: company.options[company.selectedIndex].value,
                interval: interval.options[interval.selectedIndex].value,
                limits: numberOfRecords.value,
                start: date.vaue
            }
            $.post("https://sedelkin.ru/api/history/get_data", params).done(function (data){
                console.log(data);
            });
        }
    }

    span = document.querySelector('.span');

    function validateForm(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req');

        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input);

            if (input.classList.contains('_numbersOfRecords')) {
                if (numberOfRecords.value > 1700 || numberOfRecords.value < 1) {
                    formAddError(input);
                    error++;
                }
            } else if (input.classList.contains('_data')) {
                if (date.valueAsDate > new Date()) {
                    formAddError(input);
                    error++;
                }
            } else if (input.classList.contains('_companyName')) {
                if (input.options[input.selectedIndex].value === "Выберите компанию") {
                    formAddError(input);
                    error++;
                }
            } else if (input.classList.contains('_interval')) {
                if (input.options[input.selectedIndex].value === "Выберите интервал") {
                    formAddError(input);
                    error++;
                }
            } else {
                if (input.value === "") {
                    formAddError(input);
                    error++;
                }
            }
        }
        return error;
    }

    function formAddError(input) {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }

    function formRemoveError(input) {
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }
});
