<?php

namespace model;

class User
{

    private int $use_id;
    private string $use_email;
    private string $use_password;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getUseId(): int
    {
        return $this->use_id;
    }

    /**
     * @param int $use_id
     */
    public function setUseId(int $use_id): void
    {
        $this->use_id = $use_id;
    }

    /**
     * @return string
     */
    public function getUseEmail(): string
    {
        return $this->use_email;
    }

    /**
     * @param string $use_email
     */
    public function setUseEmail(string $use_email): void
    {
        $this->use_email = $use_email;
    }

    /**
     * @return string
     */
    public function getUsePassword(): string
    {
        return $this->use_password;
    }

    /**
     * @param string $use_password
     */
    public function setUsePassword(string $use_password): void
    {
        $this->use_password = $use_password;
    }
}