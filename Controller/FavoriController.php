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
//            header(AppConstant::$HEADER_LOCATION_LABEL . AppConstant::$SIGNUP_LOCATION_URL);
            FavoriService::deleteLinkFavorisAnnonce($userConnect);
//            exit('success');
//            return http_response_code(200);
            echo "OK";
        }

    }
}