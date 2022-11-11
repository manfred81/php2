<?php

use App\Blog\Commands\Arguments;
use App\Blog\Commands\CreateUserCommand;
use App\Blog\Post;
use App\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use App\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use App\Blog\UUID;


include __DIR__ . '/vendor/autoload.php';


$connection = new PDO('sqlite:' . __DIR__ . 'blog.sqlite');

$usersRepository = new SqliteUsersRepository($connection);
$postssRepository = new SqlitePostsRepository($connection);

try {

    $user = $usersRepository->get(new UUID('123'));

    $post = $postssRepository->get(new UUID(''));


    // $post = new Post(
    //     UUID::random(),
    //     $user,
    //     'Заголовок',
    //     'Текст',
    // );
} catch (Exception $e) {
    echo $e->getMessage();
}







print_r($user);

// $command = new CreateUserCommand($usersRepository);

// try{
//     $command->handle(Arguments::fromArgv($argv));
// } catch (Exception $e){
//     echo $e->getMessage();
// }