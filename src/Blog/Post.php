<?php

namespace App\Blog;



class Post
{
    private int $id;
    private User $user;
    private string $text;

    public function __construct(

        int $id,
        User $user,
        string $text
    ) {
        $this->id = $id;
        $this->text = $text;
        $this->author = $user;
    }

    public function __toString()
    {
        return $this->user . ' пишет:' . $this->text . PHP_EOL;
    }

    /**
     * Get the value of id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Get the value of text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
