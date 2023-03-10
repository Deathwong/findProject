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
        AnnonceService::deleteAnnonce();
    }

    // La fonction permettant de supprimer une annonce
    public static function updateAnnonce(): void
    {
        AnnonceService::updateAnnonce();
    }

    // La fonction permettant de récupérer toutes les annonces
    public static function getAllAnnonce(): array
    {
        return AnnonceService::getAllAnnonce();
    }
}