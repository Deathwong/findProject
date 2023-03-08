<?php

namespace service;

use model\Annonce;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Annonce.php';

class AnnonceService
{

    public static function getAnnonceDetails(): Annonce
    {
        //on récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        //on récupère l'id de l'annonce
        $idAnnonce = getElementInRequestByAttribute("idAnnonce");

        //la requête
        $query = "select a.* from annonce a where a.ann_id = :idAnnonce";

        //on fait le prépare statement
        $request = $connection->prepare($query);

        $request->bindParam("idAnnonce", $idAnnonce);

        $request->execute();

        return $request->fetchObject(Annonce::class);
    }
}