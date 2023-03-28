<?php

namespace Controller;

use model\Annonce;
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
        // TODO : récupérer l'iduser de l'annonce qu'on veux supprimer et le comparer avec l'id user connecter (session)
        AnnonceService::deleteAnnonce();
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