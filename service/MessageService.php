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

        // On récupère l'id de l'utilisateur
        $useId = $user->getUseId();

        // On récupère le nombre de conversations
        $conversationsNumber = self::getConversationNumberByUserId($connection, $useId);
        $conversationsNumber = intval($conversationsNumber);


        // Cette requette permet de récupérer l'id de l'annonce le nom la photo l'interlocuteur son id son mail
        // et le dernier message envoyé dans la conversation
        $query = 'SELECT ann.ann_id as idAnnonce, ann.ann_nom as nomAnnonce, ann.ann_photo as photo, 
                    u.use_id as interlocuteurId,
                    u.use_email as interlocuteur, mes.mes_content as message
                    FROM conversation con 
                    JOIN annonce ann ON ann.ann_id = con.con_id
                    JOIN (
                        SELECT mes.con_id, MAX(mes.mes_create_at) AS max_create_at
                        FROM message mes
                        GROUP BY mes.con_id
                    ) max_mess ON con.con_id = max_mess.con_id
                    JOIN message mes ON con.con_id = mes.con_id AND mes.mes_create_at = max_mess.max_create_at
                    JOIN `user` u ON con.con_user_id = u.use_id OR con.con_seller_id = u.use_id  
                    JOIN (
                        SELECT DISTINCT CASE 
                            WHEN con.con_user_id = :userId THEN con.con_seller_id 
                            WHEN con.con_seller_id = :userId THEN con.con_user_id 
                            END AS interlocutor_id
                        FROM conversation con 
                        WHERE con.con_seller_id = :userId OR con.con_user_id = :userId
                    ) interlocutor ON (interlocutor.interlocutor_id = u.use_id AND u.use_id != :userId)
                    WHERE con.con_seller_id = :userId OR con.con_user_id = :userId 
                    GROUP BY con.con_id 
                    ORDER BY max_mess.max_create_at DESC
                    LIMIT :conversationsNumber';

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":userId", $useId);
        $request->bindParam(":conversationsNumber", $conversationsNumber);

        // On execute
        $request->execute();

        // On retourne la valeur reçue
        return $request->fetchAll(PDO::FETCH_CLASS, MessageCardDto::class);
    }

    public static function getDiscussion(User $user): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'interlocuteur
        $idInterlocuteur = getElementInRequestByAttribute("use_id");
        $idAnnonce = getElementInRequestByAttribute("ann_id");

        $query = "select  * from  message where  ((mes_sender_id = :idUser and use_receiver_id = :userId) or
                                (mes_sender_id = :userId and use_receiver_id = :idUser)) and ann_id = :idAnnonce  
                        order by mes_create_at desc";

        // On récupère l'id du user connecté
        $useId = $user->getUseId();

        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":idUser", $useId);
        $request->bindParam(":userId", $idInterlocuteur);
        $request->bindParam(":idAnnonce", $idAnnonce);

        $request->execute();

        $discussions = $request->fetchAll(PDO::FETCH_CLASS, Message::class);
        return $discussions;
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

    /**
     * Permet de récupérer le nombre de conversations de l'utilisateur en lui passant en paramètre l'id de l'utilisateur
     * @param PDO $connection
     * @param int $useId
     * @return string
     */
    public static function getConversationNumberByUserId(PDO $connection, int $useId): string
    {
        // On récupère le nombre de conversations de l'utilisateur connecté
        $query = "select count(1) from conversation c where con_user_id or con_seller_id = :userId ";

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // On fait le bidding
        $request->bindParam(":userId", $useId);

        // On execute
        $request->execute();

        return $request->fetchColumn();
    }
}