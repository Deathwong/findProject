<?php

namespace Controller;

use model\User;
use service\UserService;

require_once "../service/UserService.php";

class UserController
{

    public static function getUsers(): array
    {
        return UserService::getUsers();
    }

    public static function createUser(): void
    {
        UserService::createUser();
    }

    public static function connectUser(): void
    {
        UserService::connectUser();
    }

    public static function getUserDetails(): User
    {
        return UserService::getUserDetails();
    }
}