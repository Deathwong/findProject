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
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce
        $idAnnonce = getElementInRequestByAttribute("idAnnonce");

        // Requête ramenant l'annonce et les différentes catégories séparées par une virgule
        $query = "select ann.*, GROUP_CONCAT(cat.cat_libelle) as categories from annonce ann join categorie_annonce ca 
            ON ann.ann_id = ca.ann_id join categorie cat on ca.cat_id = cat.cat_id where ann.ann_id = :idAnnonce";

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // On fait le binding
        $request->bindParam("idAnnonce", $idAnnonce);

        // On exécute la requête
        $request->execute();

        // On retourne l'annonce
        return $request->fetchObject(Annonce::class);
    }

    public static function updateAnnonce(): void
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $Annonce = self::getAnnonceValues();

    }

    public static function getAnnonceValues(): array
    {
        $annonce = [
            "use_id" => getElementInRequestByAttribute("use_id"),
            "ann_nom" => getElementInRequestByAttribute("ann_nom"),
            "ann_prix" => getElementInRequestByAttribute("ann_prix"),
            "ann_description" => getElementInRequestByAttribute("ann_description")
        ];

        if (getElementInRequestByAttribute("ann_id")) {
            $annonce[] = getElementInRequestByAttribute("ann_id");
            //array_push($annonce,getElementInRequestByAttribute("ann_id"));
        }

        return $annonce;
    }
}