<?php

namespace service;

use PDO;
use PDOException;

/**
 * @property PDO $connection
 */
class PdoConnectionHandler
{
    const DATA_BASE_NAME = "find";
    const HOST = "localhost";
    const PORT = "3306";
    const USER_NAME = "root";
    const PASS_WORD = "";
    private static PDO $instance;

    private function __construct()
    {
        self::$instance = $this->getBddConnection();
    }

    public static function getPDOInstance(): PDO
    {
        if (!isset(self::$instance)) {
            new PdoConnectionHandler();
        }

        return self::$instance;
    }

    /**
     * Permet de récupérer une connection à la base de données
     */
    private function getBddConnection(): PDO
    {
        try {
            $dataSourceName = 'mysql:dbname=' . self::DATA_BASE_NAME . ';host=' . self::HOST . ';port:' . self::PORT .
                ';charset=utf8mb4';
            $bdd = new PDO($dataSourceName, self::USER_NAME, self::PASS_WORD);
            $bdd->exec("set names utf8mb4");

            // set the PDO error mode to exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            return $bdd;

        } catch (PDOException $error) {
            $messageErreur = 'ERREUR PDO dans ' . $error->getFile() . ' L.' . $error->getLine() . ' : '
                . $error->getMessage();
            die($messageErreur);
        }
    }
}



