<?php

namespace service;

use dto\ConversationCard;
use model\Message;
use model\User;
use PDO;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Message.php';
require '../dto/ConversationCard.php';

class MessageService
{

//    public static function sendMessage(): void
//    {
//
//    }

    public static function getConversationsCards(User $user): array
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On récupère l'id de l'utilisateur
        $useId = $user->getUseId();


        // Cette requette permet de récupérer l'id de l'annonce le nom la photo l'interlocuteur son id son mail
        // et le dernier message envoyé dans la conversation
        $query = 'select
                    con.con_id as idConversation,
                    ann.ann_id as annonceId,
                    ann.ann_nom as annonceNom,
                    ann.ann_photo as photo,
                    usAcheteur.use_id as acheteurId,
                    usAcheteur.use_email as acheteurEmail,
                    usVendeur.use_id as vendeurId,
                    usVendeur.use_email as vendeurEmail,
                    mes.mes_id as messageId,
                    mes.mes_content as message,
                    mes.mes_create_at as date
                from
                    conversation con
                left join annonce ann on
                    ann.ann_id = con.ann_id
                left join `user` usAcheteur on
                    usAcheteur.use_id = con.con_user_id
                left join `user` usVendeur on
                    usVendeur.use_id = con.con_seller_id
                left join message mes on
                    mes.con_id = con.con_id
                where
                    (con.con_user_id = :userId
                        or con.con_seller_id = :userId)
                    and mes.mes_create_at = (
                    select
                        max(m.mes_create_at)
                    from
                        message m
                    where
                        m.con_id = con.con_id)
                group by
                    mes.con_id
                order by
                    mes.mes_create_at desc';

        // On fait le prépare statement
        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":userId", $useId);

        // On execute
        $request->execute();

        // On retourne la valeur reçue
        return $request->fetchAll(PDO::FETCH_CLASS, ConversationCard::class);
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

        return $request->fetchAll(PDO::FETCH_CLASS, Message::class);
    }

    public static function sendMessage(User $user): void
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        //  Récupération des valeurs issues de la requête http pour créer le message
        $messageHttpRequestValues = self::getMessageHttpRequestValues();

        $messageHttpRequestValues["mes_sender_id"] = $user->getUseId();

        $query = "INSERT INTO find.message(con_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
                    VALUES(:con_id, :mes_sender_id, :use_receiver_id, :mes_content, now())";

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