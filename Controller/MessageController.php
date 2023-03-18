<?php

namespace Controller;

use model\AppConstant;
use service\MessageService;

require '../service/MessageService.php';

class MessageController
{
    public static function getUserChatBox()
    {
        // Récupération de l'User
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);

        if (isset($userConnect)) {
            return MessageService::getUserChatBox($userConnect);
        }
    }
}