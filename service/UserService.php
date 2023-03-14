<?php

namespace service;

use model\AppConstant;
use model\User;
use PDO;

require_once "PdoConnectionHandler.php";
require_once "../utils/utils.php";
require "../model/User.php";


class UserService
{
    public static function getUsers(): array
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $query = "select * from user order by use_id";
        $request = $connection->prepare($query);

        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public static function createUser(): void
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        // Gestion de la récupération des inputs du formulaire
        $email = getElementInRequestByAttribute("email");
        $password = getElementInRequestByAttribute("password");
        $encryptedMd5Password = md5($password);

        $query = "insert into user (use_email, use_password) VALUE (:email, :password)";
        $params = [
            "email" => $email,
            "password" => $encryptedMd5Password
        ];

        $request = $connection->prepare($query);

        // Execute the query
        $request->execute($params);
        $lastInsertID = $connection->lastInsertId();

        header("location:detailsUser.php?userId=$lastInsertID");
    }

    public static function connectUser(): void
    {
        $password = getElementInRequestByAttribute("password");
        $encryptedMd5Password = md5($password);
        $email = getElementInRequestByAttribute("email");

        // Recherche de l'utilisateur grâce à l'email qui est tapé par la personne qui veut se connecter
        $user = self::getUserByEmail($email);

        self::initErrorConnection();

        if (!empty($user)) {

            $passwordBdd = $user->getUsePassword();

            if ($passwordBdd == $encryptedMd5Password) {

                $_SESSION[AppConstant::USE_ID_SESSION_KEY] = $user;
                header("location:../views/");
            } else {
                $_SESSION["errorPassword"] = "Mauvais Mot de passe";
                header("location:../views/signin.php");
            }

        } else {
            $_SESSION["errorEmail"] = "Ce nom d'utilisateur n'existe pas";
            header("location:../views/signin.php");
        }

    }

    public static function getUserByEmail($email): bool|User
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $query = "select u.* from user u where use_email = :email";
        $request = $connection->prepare($query);
        $request->bindParam(':email', $email);

        $request->execute();
        return $request->fetchObject(User::class);
    }

    public static function getUserDetails(): User
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $userId = $_GET["userId"];

        $query = "select u.* from user u where use_id = :userId";

        $request = $connection->prepare($query);
        $request->bindParam(":userId", $userId);

        $request->execute();

        return $request->fetchObject(User::class);
    }

    public static function getUserConnected($id): ?User
    {
        $userConnecter = $_SESSION[$id];
        return $userConnecter ?? null;
    }

    /**
     * @return void
     */
    public static function initErrorConnection(): void
    {
        $_SESSION["errorPassword"] = null;
        $_SESSION["errorEmail"] = null;
    }
}