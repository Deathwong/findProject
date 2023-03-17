<?php

namespace service;

use model\Annonce;
use model\AppConstant;
use PDO;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Annonce.php';
require_once 'CategoryAnnonceService.php';

class AnnonceService
{

    public static function getAnnonceDetails(): Annonce
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce
        $idAnnonce = getElementInRequestByAttribute("idAnnonce");

        // Requête ramenant l'annonce et les différentes catégories séparées par une virgule
        $query = "select ann.*, GROUP_CONCAT(cat.cat_id,cat.cat_libelle) as categories from annonce ann join categorie_annonce ca 
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
        $annonce = self::getAnnoncesHttpRequestValues();

        $idAnnonce = $annonce["ann_id"];

        $query = "update annonce a set a.ann_nom = :ann_nom , a.ann_prix = :ann_prix, 
                     a.ann_description = :ann_description, a.ann_update_at = now() where ann_id = :ann_id ";

        $request = $connection->prepare($query);

        $request->execute($annonce);

        if (getElementInRequestByAttribute("ann_photo") !== null) {
            self::insertPhotoNameInAnnonce($idAnnonce, $connection);
        }

        CategoryAnnonceService::deleteLinkCategoriesAnnonce($idAnnonce);

        self::updateCategoriesAnnonce($idAnnonce);

        header(AppConstant::$HEADER_LOCATION_LABEL . AppConstant::$EDIT_ANNONCE_LOCATION_LABEL . '?idAnnonce=' . $idAnnonce);
    }

    public static function getAnnoncesHttpRequestValues(): array
    {
        $annonce = [
            "ann_nom" => getElementInRequestByAttribute("ann_nom"),
            "ann_prix" => getElementInRequestByAttribute("ann_prix"),
            "ann_description" => getElementInRequestByAttribute("ann_description")
        ];

        // On vérifie si l'on reçoit bien un id d'annonce
        if (getElementInRequestByAttribute("ann_id") !== null) {
            // On ajoute l'id d'annonce
            $annonce["ann_id"] = getElementInRequestByAttribute("ann_id");
            //array_push($annonce,getElementInRequestByAttribute("ann_id"));
        }

        return $annonce;
    }

    public static function updateCategoriesAnnonce($idAnnonce): void
    {
        $connection = PdoConnectionHandler::getPDOInstance();

        $categories = getElementInRequestByAttribute("cat_id");

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
        FavoriService::deleteLinkFavorisByIdAnnonce($idAnnonce);

        $query = "delete from annonce WHERE ann_id = :idAnnonce";

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // On fait le binding
        $request->bindParam("idAnnonce", $idAnnonce);

        // On exécute la requête
        $request->execute();

        header('location:' . AppConstant::$LISTE_USERS_URL);
    }

    public static function getAllAnnonce(): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();
        $mainQuery = "select ann.* from annonce ann ";

        // Initialisation des tableaux ses conditions et paramètres de la requête de la recherche
        $conditions = [];
        $parameters = [];

        // On filtre sur les catégories, le nom et le prix.
        // Nom de l'annonce
        if (isset($_POST['nom']) || isset($_GET['nom'])) {
            $nom = getElementInRequestByAttribute("nom");
            $conditions[] = 'ann.ann_nom LIKE :nom';
            $parameters['nom'] = '%' . $nom . "%";
        }

        // Catégories de l'annonce
        if (isset($_POST['categorieId']) || isset($_GET['categorieId'])) {
            $categorie = getElementInRequestByAttribute("categorieId");
            $joinQuery = 'join categorie_annonce ca on ann.ann_id = ca.ann_id join categorie cat on cat.cat_id = ca.cat_id';
            $mainQuery .= $joinQuery;
            $conditions[] = 'cat.cat_id = :categorieId';
            $parameters['categorieId'] = $categorie;
        }

        // Prix  Minimum
        if (isset($_POST['prix_min']) || isset($_GET['prix_min'])) {
            $prixMin = getElementInRequestByAttribute("prix_min");
            $conditions[] = 'ann.$prix >= :prixMin';
            $parameters['prix_min'] = $prixMin;
        }

        // Prix  Maximum
        if (isset($_POST['prix_max']) || isset($_GET['prix_max'])) {
            $prixMax = getElementInRequestByAttribute("prix_max");
            $conditions[] = 'ann.$prix <= :prixMax';
            $parameters['prix_max'] = $prixMax;
        }

        if ($conditions) {
            $mainQuery .= " WHERE " . implode(" AND ", $conditions);
        }

        // Ajout du tri. Les dernières annonces créées ou mise à jour (tri descendant)
        $sortQuery = ' order by ann_update_at desc';
        $mainQuery .= $sortQuery;


        $statement = $connection->prepare($mainQuery);
        $statement->execute($parameters);

        // Cas d'une requête AJAX envoyé en méthode Http POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $result = $statement->fetchAll(PDO::FETCH_BOTH);

            // Construction de la liste d'annonce afin de l'envoyé au format JSON
            $listAnnonce = [];
            foreach ($result as $annonce) {
                $listAnnonce[] = array(
                    'ann_id' => $annonce['ann_id'],
                    'use_id' => $annonce['use_id'],
                    'ann_nom' => $annonce['ann_nom'],
                    'ann_prix' => $annonce['ann_prix'],
                    'ann_description' => $annonce['ann_description'],
                    'ann_photo' => $annonce['ann_photo'],
                    'ann_nombre_consultation' => $annonce['ann_nombre_consultation'],
                    'ann_create_at' => $annonce['ann_create_at'],
                    'ann_update_at' => $annonce['ann_update_at']);
            }
            return $listAnnonce;
        }

        // Cas d'une requête de recherche envoyé en méthode Http GET
        return $statement->fetchAll(PDO::FETCH_CLASS, Annonce::class);
    }

    public static function createAnnonce(): int
    {

        // Récupération de la connexion PDO
        $connection = PdoConnectionHandler::getPDOInstance();

        // Requête SQL pour insérer une nouvelle annonce
        $query = "insert into annonce(use_id, ann_nom, ann_prix, ann_description, ann_nombre_consultation, 
                    ann_create_at, ann_update_at) 
            values (:use_id, :ann_nom, :ann_prix, :ann_description, :ann_nombre_consultation, now(), now())";

        $request = $connection->prepare($query);

        // Récupération des valeurs issues de la requête http pour créer l'annonce
        $annonceHttpRequestValues = self::getAnnoncesHttpRequestValues();

        // Exécution de la requête
        $request->execute($annonceHttpRequestValues);

        // Récupération de l'identifiant de l'annonce créée
        $ann_id = $connection->lastInsertId();

        // Message d'erreur. Si l'annonce n'a pas été créé
        if (!$ann_id) {
            // TODO Gestion de l'erreur. S'inspirer de la création d'un user
        }

        // Transformation du nom de l'image (id de l'annonce créée
        $transformFileName = getFileNamePlusExtension('ann_photo', $ann_id);

        // TODO Enregitrer l'image en faisant un update de l'annonce qui vient d'etre créer

        // Retour de l'identifiant de l'annonce créée
        return (int)$ann_id;
    }

    /**
     * @param mixed $idAnnonce
     * @param PDO $connection
     * @return void
     */
    public static function insertPhotoNameInAnnonce(mixed $idAnnonce, PDO $connection): void
    {
        $photo = getFileNamePlusExtension("ann_photo", $idAnnonce);

        $query = "UPDATE annonce a SET a.ann_photo = :photo WHERE ann_id = :idAnnonce";

        $requestPhotoAnnonce = $connection->prepare($query);

        $requestPhotoAnnonce->bindParam(':photo', $photo);
        $requestPhotoAnnonce->bindParam(':idAnnonce', $idAnnonce);

        $requestPhotoAnnonce->execute();
    }
}