<?php

namespace App\Blog\UnitTests;

use App\Blog\Exception\PostNotFoundException;
use App\Blog\Post;
use App\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use App\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use App\Blog\User;
use App\Blog\UUID;
use App\Person\Name;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

class SqlitePostsRepositoryTest extends TestCase
{
    public function testItThrowsAnExceptionWhenPostNotFound(): void
    {
        $connectionMock = $this->createStub(PDO::class);
        $statementStub = $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionMock->method('prepare')->willReturn($statementStub);

        $repository = new SqlitePostsRepository($connectionMock);

        $this->expectExceptionMessage('Cannot find post: 123e4567-e89b-12d3-a456-426614174000');
        $this->expectException(PostNotFoundException::class);
        $repository->get(new UUID('123e4567-e89b-12d3-a456-426614174000'));
    }
    public function testItSavesPostToDatabase(): void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementMock = $this->createMock(PDOStatement::class);

        $statementMock
        ->expects($this->once())
        ->method('execute')
        ->with([
            ':uuid' => '123e4567-e89b-12d3-a456-426614174000',
            ':author_uuid' => '123e4567-e89b-12d3-a456-426614174000',
            ':title' => 'Ivan',
            ':text' => 'Nikitin',
        ]);

        $connectionStub->method('prepare')->willReturn($statementMock);
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

        $statementMock->method('fetch')->willReturn([
            ':uuid' => '123e4567-e89b-12d3-a456-426614174000',
            ':author_uuid' => '123e4567-e89b-12d3-a456-426614174000',
            ':title' => 'Заголовок',
            ':text' => 'Текст',
            ':username' => 'Ivan123',
            ':first_nsme' => 'Ivan',
            ':last_name' => 'ТNikitin',
            
        ]);

        $connectionStub->method('prepare')->willReturn($statementMock);


        $postRepository = new SqlitePostsRepository($connectionStub);
        $post = $postRepository->get(new UUID('123e4567-e89b-12d3-a456-42661417400'));
        $this->assertSame('123e4567-e89b-12d3-a456-42661417400', (string)$post->uuid());
    }
}
