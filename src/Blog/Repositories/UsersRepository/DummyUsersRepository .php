<?php
namespace App\Blog\Repositories\UsersRepository;

use App\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use App\Blog\Exception\UserNotFoundException;

use App\Blog\User;
use App\Blog\UUID;
use App\Person\Name;

// Dummy - чучуло, манекен
class DummyUsersRepository implements UsersRepositoryInterface
{
public function save(User $user): void
{
// Ничего не делаем
}
public function get(UUID $uuid): User
{
// И здесь ничего не делаем
throw new UserNotFoundException("Not found");
}
public function getByUsername(string $username): User
{
// Нас интересует реализация только этого метода
// Для нашего теста не важно, что это будет за пользователь,
// поэтому возвращаем совершенно произвольного
return new User(UUID::random(), new Name("first", "last"), "user123");
}
}
