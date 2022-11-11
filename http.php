<?php
use App\Blog\Http\Request;
require_once __DIR__ . '/vendor/autoload.php';
// Создаём объект запроса из суперглобальных переменных
$request = new Request($_GET, $_SERVER);
// Получаем данные из объекта запроса
$parameter = $request->query('some_parameter');
$header = $request->header('Some-Header');
$path = $request->path();
echo 'Hello from PHP';