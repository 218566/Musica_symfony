<?php


namespace App\Entity;


class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string;
     */
    private $login;

    /**
     * @var string;
     */
    private $password;



    public function __construct(int $id, string $login, string $password)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


}