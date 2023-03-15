<?php

namespace service;

use model\User;

require_once "PdoConnectionHandler.php";
require_once "../utils/utils.php";

//require "../model/User.php";

class FavoriService
{
    public static function deleteLinkFavorisAnnonceByUser(User $user): void
    {
        //on récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce qui vient de la requête http
        $query = "delete from favoris where ann_id = :idAnnonce and use_id = :userId";
        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $idAnnonce = getElementInRequestByAttribute("idAnnonce");
        $useId = $user->getUseId();
        $request->bindParam(":idAnnonce", $idAnnonce);
        $request->bindParam(":userId", $useId);

        //on execute la requête
        $request->execute();
    }

    public static function deleteLinkFavorisByIdAnnonce(int $idAnnonce): void
    {
        //on récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce qui vient de la requête http
        $query = "delete from favoris where ann_id = :idAnnonce";
        $request = $connection->prepare($query);

        // binding
        $request->bindParam(":idAnnonce", $idAnnonce);

        //on execute la requête
        $request->execute();
    }

    public static function addLinkFavorisAnnonce(User $user): void
    {
        //on récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        $query = "insert into favoris(ann_id, use_id) values (:annonceId, :userId)";
        $request = $connection->prepare($query);

        $params = [
            "annonceId" => getElementInRequestByAttribute("idAnnonce"),
            "userId" => $user->getUseId()
        ];

        $request->execute($params);
    }
}