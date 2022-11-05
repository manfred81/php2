<?php

namespace App\Blog\Commands;


use App\Blog\Exception\CommandException;
use App\Blog\Exception\UserNotFoundException;
use App\Blog\Exception\InvalidArgumentException;
use App\Person\Name;
use App\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use App\Blog\User;
use App\Blog\UUID;


class CreateUserCommand extends InvalidArgumentException
{
    // Команда зависит от контракта репозитория пользователей,
    // а не от конкретной реализации
    

    public function __construct(
        private UsersRepositoryInterface $usersRepository
    ) {
    }
    public function handle(Arguments $arguments): void
    {
        $username = $arguments->get('username');

        // Проверяем, существует ли пользователь в репозитории
        if ($this->userExists($username)) {
            // Бросаем исключение, если пользователь уже существует
            throw new CommandException("User already exists: $username");
        }

        // Сохраняем пользователя в репозиторий
        $this->usersRepository->save(new User(
            UUID::random(),

            new Name(
                $arguments->get('first_name'),
                 $arguments->get('last_name')),
            $username,
        ));
    }

    private function userExists(string $username): bool
    {
        try {
            // Пытаемся получить пользователя из репозитория
            $this->usersRepository->getByUsername($username);
        } catch (UserNotFoundException) {
            return false;
        }
        return true;
    }
}
