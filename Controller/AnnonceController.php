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
}