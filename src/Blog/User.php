<?php

namespace App\Blog;

use App\Person\Name;
use App\Blog\UUID;

class User
{
    private UUID $uuid;
    private Name $name;
    private string $username;

    public function __construct(UUID $uuid, Name $name, string $username)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->username = $username;
    }
    public function __toString()
    {
        return "Юзер $this->uuid с именем $this->name  и логином $this->username." . PHP_EOL;
    }

    /**
     * Get the value of id
     */


    /**
     * Get the value of uuid
     */
    public function uuid()
    {
        return $this->uuid;
    }



    /**
     * Get the value of name
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
}
