<?php

namespace GeekBrains\LevelTwo\Http\Auth;

use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Http\Request;

interface AuthenticationInterface
{
    // Контракт описывает единственный метод,
    // получающий пользователя из запроса
    public function user(Request $request): User;

}