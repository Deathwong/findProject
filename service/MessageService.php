<?php

namespace service;

use dto\MessageCardDto;
use model\Message;
use model\User;
use PDO;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Message.php';
require '../dto/MessageCardDto.php';

class MessageService
{

//    public static function sendMessage(): void
//    {
//
//    }

    public static function getMessageCards(User $user): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        $useId = $user->getUseId();

        // La requête
//        $query = "select distinct  u.* from message m
//                        join user u on m.use_receiver_id and m.mes_sender_id = u.use_id
//                     where m.mes_sender_id = :idUser or m.use_receiver_id = :idUser";

        $query = "SELECT u.use_id as receiverId, u.use_email as receiver, m.mes_content as message, 
                        a.ann_nom as nomAnnonce, a.ann_id as idAnnonce, a.ann_photo as photo
                FROM user u
                INNER JOIN message m ON u.use_id = m.mes_sender_id
                INNER JOIN annonce a ON a.ann_id = m.ann_id
                WHERE m.use_receiver_id = :idUser
                ORDER BY m.mes_create_at DESC";

        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":idUser", $useId);

        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, MessageCardDto::class);
    }

    public static function getMessages(User $user): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'interlocuteur
        $idInterlocuteur = getElementInRequestByAttribute("use_id");

        $query = "select  * from  message where  (mes_sender_id = :idUser and use_receiver_id = :userId) or 
                               (mes_sender_id = :userId and use_receiver_id = :idUser)";

        // On récupère l'id du user connecté
        $useId = $user->getUseId();

        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":idUser", $useId);
        $request->bindParam(":userId", $idInterlocuteur);

        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, Message::class);
    }

    public static function sendMessage(User $user): void
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        //  Récupération des valeurs issues de la requête http pour créer le message
        $messageHttpRequestValues = self::getMessageHttpRequestValues();

        $messageHttpRequestValues["mes_sender_id"] = $user->getUseId();

        $query = "INSERT INTO find.message(ann_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
                    VALUES(:ann_id, :mes_sender_id, :use_receiver_id, :mes_content, now())";

        $request = $connection->prepare($query);

        $request->execute($messageHttpRequestValues);
    }

    public static function getMessageHttpRequestValues(): array
    {
        return [
            "ann_id" => getElementInRequestByAttribute("ann_id"),
            "use_receiver_id" => getElementInRequestByAttribute("use_receiver_id"),
            "mes_content" => getElementInRequestByAttribute("mes_content"),
        ];
    }
}