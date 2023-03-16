<?php

namespace Controller;

use model\Annonce;
use service\AnnonceService;
use service\FavoriService;

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

    public static function createAnnonce(): int
    {
        return AnnonceService::createAnnonce();
    }
}
// La fonction permettant de supprimer un favori
public static function deleteFavori(): void
{
    FavoriService::deleteFavori();
}