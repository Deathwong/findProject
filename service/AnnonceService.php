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
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère les valeurs de l'annonce
        $annonce = self::getAnnonceFromValues();

        $idAnnonce = $annonce["ann_id"];

        $query = "update annonce a set a.ann_nom = :ann_nom , a.ann_prix = :ann_prix, 
                     a.ann_description = :ann_description where ann_id = :ann_id ";

        $request = $connection->prepare($query);

        $request->execute($annonce);

        if (getElementInRequestByAttribute("ann_photo")) {
            $param = getElementInRequestByAttribute("ann_photo");
            getFileNamePlusExtension($param, $idAnnonce);
        }

        CategoryAnnonceService::deleteLinkCategoriesAnnonce($idAnnonce);

        self::updateCategoriesAnnonce($idAnnonce);
    }

    public static function getAnnonceFromValues(): array
    {
        $annonce = [
            "ann_nom" => getElementInRequestByAttribute("ann_nom"),
            "ann_prix" => getElementInRequestByAttribute("ann_prix"),
            "ann_description" => getElementInRequestByAttribute("ann_description")
        ];

        // On vérifie si l'on reçoit bien un id d'annonce
        if (getElementInRequestByAttribute("ann_id")) {
            // On ajoute l'id d'annonce
            $annonce[] = getElementInRequestByAttribute("ann_id");
            //array_push($annonce,getElementInRequestByAttribute("ann_id"));
        }

        return $annonce;
    }
//
//    public static function deleteLinkCategoriesAnnonce($idAnnonce): void
//    {
//        $connection = PdoConnectionHandler::getPDOInstance();
//
//        $query = "delete from categorie_annonce where ann_id = :ann_id";
//
//        $request = $connection->prepare($query);
//
//        $request->bindParam(":ann_id", $idAnnonce);
//
//        $request->execute();
//    }

    public static function getCategoryFromValues(): array
    {
        // Le séparateur sur lequel on se basera pour créer le tableau de catégories
        $separator = ",";

        // On récupère les différentes catégories
        $categories = getElementInRequestByAttribute("categories");

        // On retourne un tableau de catégories
        return explode($separator, $categories);
    }

    public static function updateCategoriesAnnonce($idAnnonce): void
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $categories = self::getCategoryFromValues();


        foreach ($categories as $category) {
            $query = "insert into categorie_annonce(ann_id, cat_id) values(:ann_id, :cat_id)";

            $request = $connection->prepare($query);

            $request->bindParam(":ann_id", $idAnnonce);
            $request->bindParam(":cat_id", $category);

            $request->execute();
        }
    }

    public static function deleteAnnonce(): void
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce qui vient de la requête http (par exemple envoyé par le navigateur)
        $idAnnonce = getElementInRequestByAttribute("idAnnonce");

        // Suppression des catégories liées à l'annonce
        CategoryAnnonceService::deleteLinkCategoriesAnnonce($idAnnonce);

        // TODO : faire appelle à la fonction qui supprime les favoris liés à l'annonce

        $query = "delete from annonce WHERE ann_id = :idAnnonce";

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // On fait le binding
        $request->bindParam("idAnnonce", $idAnnonce);

        // On exécute la requête
        $request->execute();

        header('location:' . UriHandler::$LISTE_USERS_URL);
    }

    public static function getAllAnnonce(): array
    {
        /*
         * 1 récupérer la connection
         * 2 écrire la requête
         * 3 Exécuter la requête
         * 4 Fecth et retourner l'array de la liste des annonces
         * (return $request->fetchAll(PDO::FETCH_CLASS, Annonce::class);)
         */
        return [];
    }
}