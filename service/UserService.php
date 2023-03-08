<?php

namespace service;

use model\User;
use PDO;
use PDOException;

require_once "PdoConnectionHandler.php";
require_once "../utils/utils.php";
require "../model/User.php";


class UserService
{
    public static function getUserFromValues(): array
    {
        return [
            "use_email" => getElementInRequestByAttribute("email"),
            "use_password" => getElementInRequestByAttribute("password")
        ];
    }

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

        $query = "insert into user (use_email, use_password) VALUE (:use_email,:use_password)";

        $userValues = self::getUserFromValues();

        $request = $connection->prepare($query);

        // Execute the query
        try {
            $request->execute($userValues);
            $lastInsertID = $connection->lastInsertId();
            header("location:detailsUser.php?userId=$lastInsertID");
        } catch (PDOException $error) {
            print "Connection to data base failed: " . $error->getMessage();
            die();
        }
    }

    public static function connectUser(): void
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $passwordTyped = getElementInRequestByAttribute("password");
        $emailTyped = getElementInRequestByAttribute("email");

        $query = "select u.* from user u where use_email = :emailTyped";
        $request = $connection->prepare($query);
        $request->bindParam(':emailTyped', $emailTyped);

        $request->execute();
        $user = $request->fetchObject(User::class);

        self::initErrorConnection();

        if (!empty($user)) {
            $passwordUser = $user->getUsePassword();
            if ($passwordUser == $passwordTyped) {
                $_SESSION["use_id"] = $user;
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