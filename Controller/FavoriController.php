<?php

namespace Controller;

use model\AppConstant;
use service\FavoriService;

require_once '../service/FavoriService.php';

class FavoriController
{
    public static function deleteLinkFavorisAnnonce(): void
    {
        // Récupération de l'User
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);

        if (isset($userConnect)) {
            FavoriService::deleteLinkFavorisAnnonceByUser($userConnect);
            echo AppConstant::HTTP_REQUEST_SUCCESS;
        }
    }

    public static function addLinkFavorisAnnonce()
    {
        // Récupération de l'User
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);

        if (isset($userConnect)) {
            FavoriService::addLinkFavorisAnnonce($userConnect);
            echo AppConstant::HTTP_REQUEST_SUCCESS;
        }
    }
}