<?php

namespace App\Blog\UnitTests;

use App\Blog\Post;
use App\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use App\Blog\User;
use App\Blog\UUID;
use App\Person\Name;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

class SqliteUsersRepositoryTest extends TestCase
{
    public function testItThrowsAnExceptionWhenUserNotFound(): void
    {
    }
    public function testItSavesUserToDatabase(): void
    {
        $connectionStub = $this->createStub(PDO::class);
        // 4. Создаём мок запроса, возвращаемый стабом подключения
        $statementMock = $this->createMock(PDOStatement::class);

        $repository = new SqlitePostsRepository($connectionStub);

        $user = new User(
            new UUID('123e4567-e89b-12d3-a456-426614174000'),
            new Name('first_name', 'last_name'),
            'name'

        );
        $repository->save(
            new Post( // Свойства пользователя точно такие,
                // как и в описании мока
                new UUID('123e4567-e89b-12d3-a456-42661417400'),
                $user,
                'Ivan',
                'Nikitin'
            )
        );


    }
    public function testItGetPostByUuid(): void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementMock = $this->createMock(PDOStatement::class);



        $postRepository = new SqlitePostsRepository($connectionStub);
        $post = $postRepository->get(new UUID(''));
        $this->assertSame('', (string)$post->getUuid());

    }
}