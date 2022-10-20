<?php

namespace App\Blog\Repositories\UsersRepository;


use App\Blog\Exception\UserNotFoundException;
use App\Blog\User;
use App\Blog\UUID;
use App\Person\Name;
use \PDO;
use \PDOStatement;

class SqliteUsersRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): void
    {

        $statement = $this->connection->prepare(
            'INSERT INTO users (first_name, last_name, uuid, username) VALUES (:first_name, :last_name, :uuid, :username)'
        );
        // Выполняем запрос с конкретными значениями
        $statement->execute([
            ':first_name' => $user->name()->first(),
            ':last_name' => $user->name()->last(),
            ':uuid' => (string)$user->uuid(),
            ':username' => $user->username(),

        ]);
    }

    public function get(UUID $uuid): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE uuid = ?'
        );
        $statement->execute([(string)$uuid]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // Бросаем исключение, если пользователь не найден
        if ($result === false) {
            throw new UserNotFoundException(
                "Cannot get user: $uuid"
            );
        }
        return $this->getUser($statement, $uuid);
    }

    public function getByUsername(string $username): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE username = :username'
        );
        $statement->execute([
            ':username' => $username,
        ]);
        return $this->getUser($statement, $username);
    }


    private function getUser(PDOStatement $statement, string $errorstring): User
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new UserNotFoundException(
                "Connot find user: $errorstring"
            );
        }
        return new User(

            new UUID($result['uuid']),
            new Name($result['first_name'], $result['last_name']),
            $result['username'],
        );
    }
}
