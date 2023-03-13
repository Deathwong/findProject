<?php

namespace service;

use model\User;

require_once "PdoConnectionHandler.php";
require_once "../utils/utils.php";

//require "../model/User.php";

class FavoriService
{
    public static function deleteLinkFavorisAnnonce(User $user): void
    {
        //on récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce qui vient de la requete http
        $query = "delete from favoris where ann_id = :idAnnonce and use_id = :userId";
        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $idAnnonce = getElementInRequestByAttribute("idAnnonce");
        $useId = $user->getUseId();
        $request->bindParam(":idAnnonce", $idAnnonce);
        $request->bindParam(":userId", $useId);

        //on execute la requete
        $request->execute();
    }
}