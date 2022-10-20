<?php

namespace App\Blog\Repositories\UsersRepository;

use App\Blog\Exception\UserNotFoundException;
use App\Blog\User;
use App\Blog\UUID;

class InMemoryUsersRepository 
{
    private array $users = [];

    public function save(User $user): void
    {
        $this->users[] = $user;
    }

    public function get(UUID $uuid): User
    {
        foreach ($this->users as $user) {
            if ($user->$uuid() === $uuid) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $uuid");
    }
}
