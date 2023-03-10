<?php

namespace service;

use model\Category;
use PDO;

require_once "PdoConnectionHandler.php";
require '../model/Category.php';

class CategoryService
{
    public static function getAllCategories(): array
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $query = "select * from categorie";

        $result = $connection->query($query);

        return $result->fetchAll(PDO::FETCH_CLASS, Category::class);
    }
}