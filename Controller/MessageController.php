<?php

namespace Controller;

use model\AppConstant;
use service\MessageService;

require '../service/MessageService.php';

class MessageController
{
    public static function getMessageCards(): array
    {
        // Récupération de l'User
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);

        return MessageService::getMessageCards($userConnect);
    }

    public static function sendMessage(): void
    {
        $userConnect = getElementInSession(AppConstant::USE_ID_SESSION_KEY);
        MessageService::sendMessage($userConnect);
    }
}