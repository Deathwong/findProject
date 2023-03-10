<?php

namespace service;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Annonce.php';

class CategoryAnnonceService
{
    public static function deleteLinkCategoriesAnnonce($idAnnonce): void
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $query = "delete from categorie_annonce where ann_id = :ann_id";

        $request = $connection->prepare($query);

        $request->bindParam(":ann_id", $idAnnonce);

        $request->execute();
    }
}