<?php

use service\CategoryService;

require_once '../service/CategoryService.php';

class CategoryController
{

    public static function getAllCategories(): array
    {
        return CategoryService::getAllCategories();
    }
}