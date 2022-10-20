<?php

use App\Blog\Comment;
use App\Person\Name;


use App\Blog\Post;
use App\Blog\User;

require_once __DIR__ . '/vendor/autoload.php';

$faker = Faker\Factory::create('ru_RU');

// echo $faker->name() . PHP_EOL;
// echo $faker->realText(rand(100, 200)) . PHP_EOL;

$name = new Name(
    $faker->firstName('female'),
    $faker->lastName()
);

$user = new User(
    $faker->randomDigitNotNull(),
    $name,
    $faker->sentence(1)
);

$route = $argv[1] ?? null;

switch ($route) {
    case "user":
        echo $user;
        break;
    case "post":
        $post = new Post(
            $faker->randomDigitNotNull(),
            $user,
            $faker->realText(rand (50,100))
        );
        echo $post;
        break;
    case "comment":
        $post = new Post(
            $faker->randomDigitNotNull(),
            $user,
            $faker->realText(rand (50,100))
        );
        $comment = new Comment(
            $faker->randomDigitNotNull(),
            $user,
            $post,
            $faker->realText(rand (50,100))
        );
        echo $comment;

        break;
    default:
        echo "error";
}


