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

    /*
     * @joane: todo
     * 1 : mettre un commentaire de la fonctionnalité
     * 2 : créer une fonction qui appelle la fonction qui va bien d'annonceService
     */
}