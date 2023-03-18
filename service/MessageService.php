<?php

namespace service;

use model\Message;
use model\User;
use PDO;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Message.php';

class MessageService
{

//    public static function sendMessage(): void
//    {
//
//    }

    public static function getUserChatBox(User $user): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        $useId = $user->getUseId();

        // La requête
        $query = "select distinct  u.* from message m 
                        join user u on m.use_receiver_id and m.mes_sender_id = u.use_id 
                     where m.mes_sender_id = :idUser or m.use_receiver_id = :idUser";

        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":idUser", $useId);

        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public static function getMessages(User $user): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'interlocuteur
        $idInterlocuteur = getElementInRequestByAttribute("use_id");

        $query = "select  * from  message where  (mes_sender_id = :idUser and use_receiver_id = :userId) or (mes_sender_id = :userId and use_receiver_id = :idUser)";

        // On récupère l'id du user connecté
        $useId = $user->getUseId();

        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":idUser", $useId);
        $request->bindParam(":userId", $idInterlocuteur);

        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, Message::class);
    }
}