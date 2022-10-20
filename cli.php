<?php

use App\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use App\Blog\User;
use App\Blog\UUID;
use App\Person\Name;

include __DIR__ . '/vendor/autoload.php';


$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

//Создаём объект репозитория
$usersRepository = new SqliteUsersRepository($connection);
//Добавляем в репозиторий несколько пользователей

// $usersRepository->save(new User(UUID::random(), new Name('Vano', 'Nikitin'), "admin"));
// $usersRepository->save(new User(UUID::random(), new Name('Anna', 'Petrova'), "user"));
// $usersRepository->save(new User(UUID::random(), new Name('Anna', 'Petrova'), "user"));
try{
   echo $usersRepository->getByUsername('admin');
} catch (Exception $e){
    echo $e->getMessage();
}