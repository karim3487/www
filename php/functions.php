<?php
function debug($data) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function load($data): array
{
    foreach ($_POST as $k => $v) {
        if (array_key_exists($k, $data)) {
            $data[$k] ['value'] = trim($v);
        }
    }
    return $data;
}

function validate($data): string
{
    $errors = '';
//    foreach ($data as $k => $v) {
//        if (empty($v['value'])) {
//            $errors .= "<li>Вы не заполнили поле {$v['fields_name']}</li>";
//        }
//    }
    if ($data['password']['value'] !== $data['secondpassword']['value'])
        $errors .= "<li>Пароли не совпадают!</li>";
    return $errors;
}

function loadText ($data): string
{
    $str = "";
    foreach ($data as $k => $v) {
        if (!empty($v['value'])) {
            $str .= "{$v['fields_name']}: {$v['value']}\n";
        }
    }
    return $str;
}