<?php

namespace Controller;

use model\Annonce;
use model\AppConstant;
use service\AnnonceService;

require '../service/AnnonceService.php';

class AnnonceController
{

    // La fonction permettant de récupérer les Annonces
    public static function getAnnonceDetails(): Annonce
    {
        return AnnonceService::getAnnonceDetails();
    }

    // La fonction permettant de supprimer une annonce
    public static function deleteAnnonce(): void
    {
        // Récupération de l'utilisateur connecté
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);


        if ($userConnect) {

            // Récupération de l'id du user connecté
            $userConnectId = $userConnect->getUseId();

            // récupération de l'id du créateur de l'annonce
            $userAnnonceId = getElementInRequestByAttribute("userAnnonceId");

            // Comparaison des deux ids
            if ($userConnectId == $userAnnonceId) {
                AnnonceService::deleteAnnonce();
            } else {
                $_SESSION["errorDeleteAnnonce"] = "vous n'avez pas la possibilité de supprimer cette annonce";
                header(AppConstant::$HEADER_LOCATION_LABEL . AppConstant::$DETAILS_ANNONCE_LOCATION_LABEL);
            }

        } else {

            header(AppConstant::$HEADER_LOCATION_LABEL . AppConstant::$DETAILS_ANNONCE_LOCATION_LABEL);
            $_SESSION["errorDeleteAnnonce"] = "aucun utilisateur connecté";
        }
    }

    // La fonction permettant de supprimer une annonce
    public static function updateAnnonce(): void
    {
        // Validation du formulaire
        AnnonceService::validateUpdateChampsAnnonce();

        // Modification de l'annonce
        AnnonceService::updateAnnonce();
    }

    // La fonction permettant de récupérer toutes les annonces
    public static function getAllAnnonce(): array
    {
        return AnnonceService::getAllAnnonce();
    }

    // Permet de créer une annonce
    public static function createAnnonce(): void
    {
        //Validation de la création
        AnnonceService:: validationCreationChampsAnnonce();

        //création d'une annonce
        AnnonceService::createAnnonce();
    }
}