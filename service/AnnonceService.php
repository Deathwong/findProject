<?php

namespace service;

use model\Annonce;
use model\AppConstant;
use PDO;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Annonce.php';
require_once 'CategoryAnnonceService.php';
require_once 'PhotoService.php';

class AnnonceService
{

    public static function getAnnonceDetails(): Annonce
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'annonce
        $idAnnonce = getElementInRequestByAttribute("idAnnonce");

        // Requête ramenant l'annonce et les différentes catégories séparées par une virgule
        $query = "select ann.*, GROUP_CONCAT(cat.cat_id,cat.cat_libelle) as categories, 
                    GROUP_CONCAT(fav.use_id) as userIdFavoris from annonce ann 
                join categorie_annonce ca ON ann.ann_id = ca.ann_id join categorie cat on ca.cat_id = cat.cat_id 
                left join favoris fav on fav.ann_id = ann.ann_id  where ann.ann_id = :idAnnonce";

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // On fait le binding
        $request->bindParam("idAnnonce", $idAnnonce);

        // On exécute la requête
        $request->execute();

        // Incrementation du nombre de consultations
        self::incrementConsultationAnnonce($idAnnonce, $connection);

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
            PhotoService::insertPhotoNameInAnnonce($idAnnonce, $connection);
        }

        CategoryAnnonceService::deleteLinkCategoriesAnnonce($idAnnonce);

        self::updateCategoriesAnnonce($idAnnonce);

        header(AppConstant::$HEADER_LOCATION_LABEL . AppConstant::$EDIT_ANNONCE_LOCATION_LABEL . '?idAnnonce='
            . $idAnnonce);
    }

    /**
     * Incrémente la consultation de l'annonce
     * @param $idAnnonce
     * @param $connexion
     * @return void
     */
    public static function incrementConsultationAnnonce($idAnnonce, $connexion): void
    {
        $query = "update annonce ann set ann.ann_nombre_consultation = ann.ann_nombre_consultation + 1 
                   where ann.ann_id = :idAnnonce";

        $request = $connexion->prepare($query);

        $request->bindParam(":idAnnonce", $idAnnonce);

        $request->execute();
    }

    /**Récupère les champs du formulaire de l'annonce contenu dans la requête http
     * @return array
     */
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

    public static function validateUpdateChampsAnnonce(): void
    {
        $annId = getElementInRequestByAttribute('ann_id');
        $annNon = getElementInRequestByAttribute('ann_nom');
        $annPrix = getElementInRequestByAttribute('ann_prix');
        $annDescription = getElementInRequestByAttribute('ann_description');
        $catID = getElementInRequestByAttribute("cat_id");

        // Contrôle des champs obligatoires
        self::validateAnnonceUpdateRequiredFields($annId, $annNon, $annPrix, $annDescription, $catID);

        self::validateUpdateAnnonceFields($annNon, $annDescription, $annPrix, $annId);

    }

    public static function validationCreationChampsAnnone(): void
    {
        $annonce = self::getAnnoncesHttpRequestValues();

        $ann_nom = $annonce["ann_nom"];
        $ann_prix = $annonce["ann_prix"];
        $ann_photo = $annonce["ann_photo"];
        $ann_description = $annonce["ann_description"];
        $cat_id = getElementInRequestByAttribute("cat_id");

        //Contrôle des champs obligatoires
        self::validateCreationAnnonceRequiredFields($ann_nom, $ann_prix, $ann_description, $cat_id);

        self::validateCreationAnnonceFields($ann_nom, $ann_prix, $ann_description);

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

        // Supression des favoris liés à l'annonce
        FavoriService::deleteLinkFavorisByIdAnnonce($idAnnonce);

        $query = "delete from annonce WHERE ann_id = :idAnnonce";

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // On fait le binding
        $request->bindParam("idAnnonce", $idAnnonce);

        // On exécute la requête
        $request->execute();

        header("Refresh: 3; url=" . AppConstant::$INDEX_URL);
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
        if (isset($_POST['prixMin']) || isset($_GET['prixMin'])) {
            $prixMin = getElementInRequestByAttribute("prixMin");
            $conditions[] = 'ann.ann_prix >= :prixMin';
            $parameters['prixMin'] = $prixMin;
        }

        // Prix  Maximum
        if (isset($_POST['prixMax']) || isset($_GET['prixMax'])) {
            $prixMax = getElementInRequestByAttribute("prixMax");
            $conditions[] = 'ann.ann_prix <= :prixMax';
            $parameters['prixMax'] = $prixMax;
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

        //récupération de l'user connect"
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);


        // Requête SQL pour insérer une nouvelle annonce
        $query = "insert into annonce(use_id, ann_nom, ann_prix, ann_description, ann_nombre_consultation, 
                    ann_create_at, ann_update_at) 
            values (:use_id, :ann_nom, :ann_prix, :ann_description, :ann_nombre_consultation, now(), now())";

        $request = $connection->prepare($query);

        // Récupération des valeurs issues de la requête http pour créer l'annonce
        $annonceHttpRequestValues = self::getAnnoncesHttpRequestValues();

        //Initialisation à 0 du nombre de consultation
        $annonceHttpRequestValues['ann_nombre_consultation'] = 0;
        $annonceHttpRequestValues['use_id'] = $userConnect->getUseId();

        //Insérer les catégories sélectionnées
//        $query = "insert into categorie_annonce(ann_id, cat_id) values (:ann_id, :cat_id)";
//        $request= $connection->prepare($query);

        // Exécution de la requête
        $request->execute($annonceHttpRequestValues);

        // Récupération de l'identifiant de l'annonce créée
        $ann_id = $connection->lastInsertId();

        self::updateCategoriesAnnonce($ann_id);

        // Message d'erreur. Si l'annonce n'a pas été créé
        if (empty($ann_id)) {
            $_SESSION["errorCreation"] = "l'annonce n'a pas été créée";
            header("location:../views/createAnnonce.php");
        }

        // Transformation du nom de l'image (id de l'annonce créée)
        $transformFileName = getFileNamePlusExtension('ann_photo', $ann_id);

        // Enregitrer l'image en faisant un update de l'annonce qui vient d'etre créer
        PhotoService::insertPhotoNameInAnnonceByIdAnonce($ann_id, $connection, $transformFileName);

        // Retour de l'identifiant de l'annonce créée
        return (int)$ann_id;
    }

    /**
     * @param string $annId
     * @param string $annNon
     * @param string $annPrix
     * @param string $annDescription
     * @param array $catID
     * @return void
     */
    public static function validateAnnonceUpdateRequiredFields(string $annId, string $annNon, string $annPrix,
                                                               string $annDescription,
                                                               array  $catID): void
    {
        if ($annId === null || $annNon === null || $annPrix === null || $annDescription === null || $catID === null) {

            $_SESSION['errorValidateUpdateAnnonce'] = 'Veuillez renseigner les champs obligatoires suivants: ';
            $champsErrors = '';


            if ($annNon === null) {
                $champsErrors .= ' Nom';
            }

            if ($annPrix === null) {
                $champsErrors = addVirguleIfIsSet($champsErrors);
                $champsErrors .= ' Prix';
            }

            if ($annDescription === null) {
                $champsErrors = addVirguleIfIsSet($champsErrors);
                $champsErrors .= ' Description';
            }

            if ($catID === null) {
                $champsErrors = addVirguleIfIsSet($champsErrors);
                $champsErrors .= ' Catégories';
            }


            $_SESSION['errorValidateUpdateAnnonce'] .= $champsErrors;

            header("location:../views/editAnnonce.php?idAnnonce=" . $annId);
            exit();
        }
    }

    /**
     * @param string $annNon
     * @param string $annDescription
     * @param string $annPrix
     * @return void
     */
    public static function validateUpdateAnnonceFields(string $annNon, string $annDescription, string $annPrix,
                                                              $annId): void
    {
        if (!validateMaxLength(100, $annNon) || !validateMaxLength(4000, $annDescription) ||
            !validatePrice($annPrix)) {

            $_SESSION['errorValidateUpdateAnnonce'] = '';
            if (!validateMaxLength(100, $annNon)) {
                $_SESSION['errorValidateUpdateAnnonce'] .= "Le nom doit avoir au plus 100 caractères </br>";
            }

            if (!validateMaxLength(4000, $annDescription)) {
                $_SESSION['errorValidateUpdateAnnonce'] .= "Le nom doit avoir au plus 100 caractères </br>";
            }

            if (!validatePrice($annPrix)) {
                $_SESSION['errorValidateUpdateAnnonce'] .= "Veuillez saisir le prix sous un bon format</br>exemple : 9.99 ou 9";
            }

            header("location:../views/editAnnonce.php?idAnnonce=" . $annId);
            exit();
        }
    }

    public static function validateCreationAnnonceRequiredFields(string $ann_nom, string $ann_prix,
                                                                 string $ann_description, string $cat_id,
                                                                 string $ann_photo): void
    {
        if ($ann_nom === null || $ann_prix === null || $ann_description === null || $cat_id === null
            || $ann_photo === null) {

            $_SESSION['errorValidateCreationAnnonce'] = 'Veuillez renseigner les champs obligatoires suivants: ';
            $champsErrors = '';


            if ($ann_nom === null) {
                $champsErrors .= ' Nom';
            }

            if ($ann_prix === null) {
                $champsErrors = addVirguleIfIsSet($champsErrors);
                $champsErrors .= ' Prix';
            }

            if ($ann_description === null) {
                $champsErrors = addVirguleIfIsSet($champsErrors);
                $champsErrors .= ' Description';
            }

            if ($cat_id === null) {
                $champsErrors = addVirguleIfIsSet($champsErrors);
                $champsErrors .= ' Catégories';
            }
            if ($ann_photo === null) {
                $champsErrors = addVirguleIfIsSet($champsErrors);
                $champsErrors .= ' Photo';
            }


            $_SESSION['errorValidateCreationAnnonce'] .= $champsErrors;

            header("location:../views/detailsAnnonce.php?idAnnonce=" . $annId);
            exit();
        }
    }

    public static function validateCreationAnnonceFields(string $ann_nom, string $ann_description, string $ann_prix,
                                                         string $ann_photo): void
    {
        if (!validateMaxLength(100, $ann_nom) || !validateMaxLength(4000, $ann_description) ||
            !validatePrice($ann_prix)) {

            $_SESSION['errorValidateCreationAnnonce'] = '';
            if (!validateMaxLength(100, $ann_nom)) {
                $_SESSION['errorValidateCreationAnnonce'] .= "Le nom doit avoir au plus 100 caractères </br>";
            }

            if (!validateMaxLength(4000, $ann_description)) {
                $_SESSION['errorValidateCreationAnnonce'] .= "Le nom doit avoir au plus 100 caractères </br>";
            }

            if (!validatePrice($ann_prix)) {
                $_SESSION['errorValidateCreationAnnonce'] .= "Veuillez saisir le prix sous un bon format</br>exemple 
            : 9.99 ou 9";
            }
            if (!validatephotoform($ann_photo)) {
                $_SESSION['errorValidateCreationAnnonce'] .= "Veuillez entrer une image de format jpg/jprg/png et de 
                taille maximale 2Mo";
            }

            header("location:../views/detailsAnnonce.php?idAnnonce=" . $annId);
            exit();
        }
    }


}