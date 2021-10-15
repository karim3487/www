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
    foreach ($data as $k => $v) {
        if ($v['required'] && empty($v['value'])) {
            $errors .= "<li>Вы не заполнили поле {$data[$k]['fields_name']}</li>";
        }
    }
    if ($data['password']['value'] !== $data['secondpassword']['value'])
        $errors .= "<li>Пароли не совпадают!</li>";
    if ($data['reputation']['value'] < 1 || $data['reputation']['value'] > 10)
        $errors .= "<li>Репутация должна быть в диапазоне от 1 до 10</li>";
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