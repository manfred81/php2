<?php

namespace App\Blog\Repositories\PostsRepository;

use App\Blog\Exception\PostNotFoundException;
use App\Blog\Post;
use App\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use App\Blog\UUID;
use PDO;
use PDOStatement;

class SqlitePostsRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Post $post): void
    {
        $statement = $this->connection->prepare(
            'INSERT INFO posts(uuid, author_uuid, title, text) VALUE(:uuid, :author_uuid, :title, :text)'
        );



        $statement->execute([
            'uuid' => $post->uuid(),
            'autor_uuid' => $post->getUser()->uuid(),
            'title' => $post->getTitle(),
            'text' => $post->getText(),
        ]);
    }
    public function get(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);

        return $this->getPost($statement, $uuid);
    }
    private function getPost(PDOStatement $statement, string $postUuId): Post
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PostNotFoundException(
                "Cannot find post: $postUuId"
            );
        }
        $usersRepository = new SqliteUsersRepository($this->connection);
        $user = $usersRepository->get(new UUID($result['author_uuid']));

        return new Post(
            new UUID($result['uuid']),
            $user,
            $result['title'],
            $result['text']
        );
    }
}
