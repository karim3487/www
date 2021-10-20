
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Анкета</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap"
          rel="stylesheet">
    <link rel="icon" href="../image/icon.svg">
</head>
<body id="top">
<header class="header">
    <div class="wrapper">
        <div class="header__wrapper">
            <div class="header__logo">
                <a href="../index.html" class="header__logo-link">
                    <img src="../image/logo.svg" alt="Home">
                </a>
            </div>
            <nav class="header__nav">
                <ul class="header__list">
                    <li class="header__item">
                        <a href="../index.html" class="header__link">Статья</a>
                    </li>
                    <li class="header__item">
                        <a href="../statistics.html" class="header__link">Статистика</a>
                    </li>
                    <li class="header__item">
                        <a href="../notes.html" class="header__link">Заметки</a>
                    </li>
                    <li class="header__item">
                        <a href="#" class="header__link">Анкета</a>
                    </li>
                </ul>
            </nav>
            <div class="menu-burger__header">
                <span></span>
            </div>
        </div>
    </div>
</header>
<main class="main">
    <div class="wrapper">
        <div class="form__wrapper">
            <h1 class="heading">Регистрация нового пользователя</h1>
            <form class="contact-form" action="create.php" method="post" name="contact-form" enctype="multipart/form-data">
                <div class="short__input">
                    <label for="surname">
                        <p>Фамилия:</p>
                        <input type="text" placeholder="Введите фамилию" name="surname" minlength="1" maxlength="12" required>
                    </label>
                    <label for="name">
                        <p>Имя:</p>
                        <input type="text" placeholder="Введите имя" name="name" minlength="1" maxlength="12" required>
                    </label>
                    <label for="patronymic">
                        <p>Отчество <span>(необязательно)</span>:</p>
                        <input type="text" placeholder="Введите отчество" name="patronymic" maxlength="12">
                    </label>
                    <label for="email">
                        <p>Email:</p>
                        <input type="email" placeholder="example@mail.ru" name="email" required>
                    </label>
                    <label for="password">
                        <p>Пароль:</p>
                        <input type="password" name="password" minlength="8" maxlength="12" placeholder="Введите пароль" required>
                    </label>
                    <label for="secondpassword">
                        <p>Повторите пароль:</p>
                        <input type="password" name="secondpassword" minlength="8" maxlength="12" placeholder="Подтвердите пароль" required>
                    </label>
                    <label for="role">
                        <p>Роль пользователя:</p>
                        <select name="role" id="#role" required>
                            <option>Выберите роль</option>
                            <option value="admin">Администратор</option>
                            <option value="user">Пользователь</option>
                        </select>
                    </label>
                    <label for="reputation">
                        <p>Репутация пользователя:</p>
                        <input type="number" name="reputation" placeholder="от 1 до 10" min="1" max="10" required>
                    </label>
                    <label for="date">
                        <p>Дата регистрации:</p>
                        <input type="date" name="date" required>
                    </label>
                </div>
                <hr>
                <label for="image" class="choice__img">
                    <p>Выберите аватар <span>(до 1Мб, *.png, *.jpeg)</span>:</p>
                    <input type="file" name="img" placeholder="До 1Мб" accept="image/jpeg, image/png">
                </label>
                <label for="about">
                    <p>О себе <span>(Необязательно)</span>:</p>
                    <textarea name="about" id="about" placeholder="Расскажите о себе..."></textarea>
                </label>
                <hr>
                <button type="submit" class="form__button">Отправить</button>
                <button type="reset" class="form__button">Очистить форму</button>
            </form>
        </div>
    </div>
</main>
<script src="../js/lightbox-plus-jquery.js"></script>
</body>
</html>