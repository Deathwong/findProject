<?php

namespace service;

use PDO;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Message.php';

//require '../model/User.php';

class MessageService
{

//    public static function sendMessage(): void
//    {
//
//    }

    public static function getUserChatBox(): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // La requête
        $query = "select * from message m where m.mes_sender_id = :idUser or m.use_receiver_id = :idUser;";
        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
//        $useId = $user->getUseId();
        $request->bindParam(":userId", $useId);

        return $request->fetchAll(PDO::FETCH_BOTH);
    }
}