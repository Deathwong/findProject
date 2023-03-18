<?php

namespace Controller;

use model\AppConstant;
use service\MessageService;

require '../service/MessageService.php';

class MessageController
{
    public static function getUserChatBox(): array
    {
        // Récupération de l'User
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);

        return MessageService::getUserChatBox($userConnect);
    }
}