<?php
require_once '../php/functions.php';

$image = $_FILES["img"];

// валидация

// типы файлов, которые можно загружать
$types = ["image/jpeg", "image/png"];

// ищем в массиве с типами тип текущего файла
if (!in_array($image["type"], $types)) {
    die('Incorrect file type');
}

// определяем размер файла в мегабайтах
$fileSize = $image["size"] / 1000000;
// максимальный размер файла в мегабайтах
$maxSize = 1;

// проверяем, чтобы размер файла не превышал ограничение
if ($fileSize > $maxSize) {
    die('Incorrect file size');
}

// создаем папку uploads в корне проекта, если её нет
if (!is_dir('../uploads')) {
    mkdir('../uploads', 0777, true);
}

// изнаем расширение текущего файла
$extension = pathinfo($image["name"], PATHINFO_EXTENSION);
// формируем уникальное имя с помощью функции time()
$imgName = time() . ".$extension";

$fields = [
    'surname' => [
        'fields_name' => 'Фамилия',
    ],
    'name' => [
        'fields_name' => 'Имя',
    ],
    'patronymic' => [
        'fields_name' => 'Отчество',
    ],
    'email' => [
        'fields_name' => 'Email',
    ],
    'password' => [
        'fields_name' => 'Пароль',
    ],
    'secondpassword' => [
        'fields_name' => 'Подтверждения пароля',
    ],
    'role' => [
        'fields_name' => 'Роль',
    ],
    'reputation' => [
        'fields_name' => 'Репутация',
    ],
    'date' => [
        'fields_name' => 'Дата',
    ],
    'about' => [
        'fields_name' => 'О себе',
    ],
];

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Аватар и файл</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/lightbox.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap"
          rel="stylesheet">
    <link rel="icon" href="../image/icons/icon.svg">
</head>
<body>
<header class="header">
    <div class="wrapper">
        <div class="header__wrapper">
            <div class="header__logo">
                <a href="../index.html" class="header__logo-link">
                    <img src="../image/logo.svg" alt="Home">
                </a>
            </div>
        </div>
    </div>
</header>
<main class="main">
    <div class="wrapper">
        <div class="files">
            <?php
            $fields = load($fields);
                if (!is_dir('../users')) {
                    mkdir('../users', 0777, true);
                }
                $str = loadText($fields);
                $fileTxtName = time() . '.txt';
                file_put_contents("../users/" . $fileTxtName, $str);

                // загружаем файл и проверяем
                // если во премя загрузки файла произошла ошибка, возвращаем die()
                if (!move_uploaded_file($image["tmp_name"], "../uploads/" . $imgName)) {
                    die('Ошибка загрузки');
                }
                $urlIMG = "../uploads/{$imgName}";
                echo '<h1 class="heading">Все прошло успешно!</h1>';
                $url = "../users/$fileTxtName";
                $txtFile = basename($url);
            ?>
            <div class="image">
                <a href="<?= $urlIMG ?>" data-lightbox="image-5" data-title="">
                    <img src="<?= $urlIMG ?>" alt="">
                </a>
            </div>
            <?php echo '<a href="../users/' . $txtFile . '" download="">Скачать файл c данными</a>';?>
            <br><br><br>
        </div>
    </div>
</main>

<script src="../js/lightbox-plus-jquery.js"></script>
</body>
</html>



