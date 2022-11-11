<?php

namespace App\Blog\Exception\InvalidArgumentException;

use App\Blog\Exceptions\AppException;


class InvalidArgumentException extends AppException
{
    public function getName()
    {
        return 'Invalid Argument';
    }
}
