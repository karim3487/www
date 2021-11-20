company = document.querySelector('#company_name');            // получаем из нашего файла элемент с id company_name
interval = document.querySelector('#interval');               // получаем из нашего файла элемент с id interval
numberOfRecords = document.querySelector('#numberOfRecords'); // получаем из нашего файла элемент с id numberOfRecords
date = document.querySelector('#date');                       // получаем из нашего файла элемент с id date

// устанавливаем input'у с id date текущую дату
date.valueAsDate = new Date();

// request, чтобы получить security_list
$.get('https://sedelkin.ru/api/security_list',
    // функция в которую передаем js-объект
    function (data) {
    const items = Object.values(data['data']);               // items равен массиву data
    // перебираем каждый элемент массива как item
    for (let item in items) {
        let opt = document.createElement('option'); // создаем HTML-элемент <option>
        opt.value = items[item]['secid'];                    // присваиваем этому option'у значение под ключом secid
        opt.textContent = items[item]['title'];              // добавляем этому option'у текст под ключом title
        company.appendChild(opt);                            // добавляем option нашему select'у с id company_name
    }
});

// АНАЛОГИЧНО
$.get('https://sedelkin.ru/api/interval',
    function (data) { //
    const items = Object.values(data['data']);
    for (let tt in items) {
        let opt = document.createElement('option');
        opt.value = items[tt]['value'];
        opt.textContent = items[tt]['title'];
        interval.appendChild(opt);
    }
});

// проверка: Загружен ли документ
document.addEventListener('DOMContentLoaded',
    function () {                                             // функция в которую передаем js-объект
    const form = document.getElementById('form');           // нашли нашу форму в HTML-документе
    form.addEventListener('submit', formSend);                  // запрещаем отправлять форму пока не выполнится функция formSend

    async function formSend(e) {
        e.preventDefault();

        let error = validateForm();                      // выполняем функцию validateForm

        if (error !== 0) {                               // если validateForm вернула ошибки выводим alert
            alert("Введите правильные значения!")
        } else {                                         // ну, а если ошибок не нашлось, юзер - не быдло, читать умеет :3
                                                         // составляем параметры для POST-запроса
            let params = {
                app_key: 'lpDRhW4f%5Bj|i8mB~BjlCD#Ve6wAi',
                secid: company.options[company.selectedIndex].value,
                interval: interval.options[interval.selectedIndex].value,
                limits: numberOfRecords.value,
                start: date.value
            }
            // отправляем наш запрос
            $.post("https://sedelkin.ru/api/history/get_data", params).done(function (data) {
                console.log(data);                       // тут должна быть функция которая строи график исходя из полученных данных
            });
        }
    }

    function validateForm() {
        // счетчик ошибок
        let error = 0;
        // берем все input'ы с классом _req (поля которые мы хотим чтобы были обязательны для заполнения)
        // formReq - це массив
        let formReq = document.querySelectorAll('._req');

        for (let index = 0; index < formReq.length; index++) {      // пробегаемся по каждому input'у
            const input = formReq[index];
            formRemoveError(input);                                 // убираем класс _error для всех input'ов

            // если элемент массива с классом _numbersOfRecords
            if (input.classList.contains('_numbersOfRecords')) {
                if (numberOfRecords.value > 1700 || numberOfRecords.value < 1) { // проверочка на валидность
                    formAddError(input);                                         // добавляем класс _error input'у
                    error++;                                                     // ну...
                }
            } else if (input.classList.contains('_data')) {
                if (date.valueAsDate > new Date()) {
                    formAddError(input);
                    error++;
                }
            } else if (input.classList.contains('_companyName')) {
                if (input.options[input.selectedIndex].value === "Выберите компанию") { // тут я хз как иначе проверить на пустое value
                    formAddError(input);
                    error++;
                }
            } else if (input.classList.contains('_interval')) {
                if (input.options[input.selectedIndex].value === "Выберите интервал") {
                    formAddError(input);
                    error++;
                }
            } else {                                                                    // ну и проверка на пустое поле
                if (input.value === "") {
                    formAddError(input);
                    error++;
                }
            }
        }
        return error;
    }

    // ну, а эт функции, которые добаляют/удаляют класс _error у элемента и у его родителя (в нашем случае у form)
    function formAddError(input) {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }

    function formRemoveError(input) {
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }
});
