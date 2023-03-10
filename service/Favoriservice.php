<?php

namespace service;

require_once "PdoConnectionHandler.php";
require_once "../utils/utils.php";
require "../model/User.php";

class Favoriservice
{
    public static function deleteLinkFavorisAnnonce($idAnnonce): void
    {
        //on réccupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce qui vient de la requete http
        $query = "delete from favoris where fav_annonces = :idAnnonce";

        // On fait le prépare statement
        $request = $connection->prepare($query);
        //on fait le biding
        $request->bindParam(":ann_id", $idAnnonce);
        //on execute la requete
        $request->execute();

    }
}