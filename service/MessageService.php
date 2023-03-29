<?php

namespace service;

use dto\ConversationCard;
use model\User;
use PDO;

require_once 'PdoConnectionHandler.php';
require_once "../utils/utils.php";
require '../model/Message.php';
require '../dto/ConversationCard.php';

class MessageService
{

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
        $iConversation = getElementInRequestByAttribute("idConversation");

        // La requête permettant de récupérer la discussion entre 2 utilisateurs
        $query = "select * from message where con_id = :idConversation and
                            (mes_sender_id = :idUser or use_receiver_id = :idUser)";

        // On récupère l'id du user connecté
        $useId = $user->getUseId();

        $request = $connection->prepare($query);

        // Récupération des paramètres et binding
        $request->bindParam(":idUser", $useId);
        $request->bindParam(":idConversation", $iConversation);

        $request->execute();

        $allMessages = $request->fetchAll(PDO::FETCH_BOTH);

        $listMessage = [];

        foreach ($allMessages as $message) {
            $listMessage[] = array(
                'mes_id' => $message["mes_id"],
                'con_id' => $message["con_id"],
                'mes_sender_id' => $message["mes_sender_id"],
                'use_receiver_id' => $message["use_receiver_id"],
                'mes_content' => $message["mes_content"],
                'mes_create_at' => $message["mes_create_at"]
            );
        }

        return $listMessage;
    }

    public static function sendMessage(User $user): void
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // On crée la conversation en récupérant son id
        $idConversation = self::createConversation($user, $connection);

        // Récupération des valeurs issues de la requête http pour créer le message
        $messageHttpRequestValues = self::getMessageHttpRequestValues();

        // On met dans le tableau l'id de la conversation
        $messageHttpRequestValues["con_id"] = $idConversation;

        // On met dans le tableau l'id du user connecté
        $messageHttpRequestValues["mes_sender_id"] = $user->getUseId();

        // La requête permettant d'envoyer un message
        $query = "INSERT INTO find.message (con_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
                    VALUES(:con_id , :mes_sender_id, :use_receiver_id, :mes_content, now())";

        // On prépare la requête
        $requestMessage = $connection->prepare($query);

        // On execute la requête
        $requestMessage->execute($messageHttpRequestValues);
    }

    public static function getMessageHttpRequestValues(): array
    {
        return [
            "use_receiver_id" => getElementInRequestByAttribute("use_receiver_id"),
            "mes_content" => getElementInRequestByAttribute("mes_content"),
        ];
    }

    public static function getConversationHttpRequestValues(): array
    {
        return [
            "con_seller_id" => getElementInRequestByAttribute("use_receiver_id"),
            "ann_id" => getElementInRequestByAttribute("ann_id"),
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

    /**
     * @param User $user
     * @param PDO $connection
     * @return int
     */
    public static function createConversation(User $user, PDO $connection): int
    {
        // Récupération de la conversation
        $conversationHttpRequestValues = self::getConversationHttpRequestValues();

        // Récupération de l'id de l'utilisateur connecté
        $conversationHttpRequestValues["con_user_id"] = $user->getUseId();

        // La requête permettant de créer une conversation
        $query = "INSERT INTO find.conversation (ann_id, con_user_id, con_seller_id, con_create_at)
                    VALUES(:ann_id, :con_user_id, :con_seller_id, now())";

        // On prépare la requête
        $requestConversation = $connection->prepare($query);

        // On execute la requête
        $requestConversation->execute($conversationHttpRequestValues);

        // On retourne l'id de la conversation crée
        return $connection->lastInsertId();
    }

    public static function sendMessageAjax(User $user): void
    {
        // On récupère la connection
        $connection = PdoConnectionHandler::getPDOInstance();

        // Récupération de l'id de l'utilisateur connecté
        $userId = $user->getUseId();

        // On récupère l'id de la conversation
        $idConversation = getElementInRequestByAttribute("idConversation");

        // On récupère l'id de l'interlocuteur
        $interlocuteur = getElementInRequestByAttribute("interlocuteur");

        // On récupère le message
        $message = getElementInRequestByAttribute("message");

        // La requête
        $query = "INSERT INTO message(con_id, mes_sender_id, use_receiver_id, mes_content, mes_create_at)
                    VALUES(:con_id , :mes_sender_id, :use_receiver_id, :mes_content, now())";

        // On prépare la requête
        $request = $connection->prepare($query);

        // On fait le binding de values
        $request->bindParam(':con_id', $idConversation);
        $request->bindParam(':mes_sender_id', $userId);
        $request->bindParam(':use_receiver_id', $interlocuteur);
        $request->bindParam(':mes_content', $message);

        $request->execute();
    }

    public static function deleteMessages(PDO $connection, string $idAnnonce): void
    {
        // le séparateur qui va nous permettre de créer le tableau
        $separator = ",";
        // On récupère les ids des différentes conversations
        $idsConversation = self::getConversationsByIdAnnonce($connection, $idAnnonce);


        if ($idsConversation) {
            // Construction du tableau d'id des conversations
            $arrayIdsConversation = explode($separator, $idsConversation);

            foreach ($arrayIdsConversation as $idConversation) {

                // La requête
                $query = "delete from message where con_id = :idsConversation";

                // On prépare la requête
                $request = $connection->prepare($query);

                // On fait le binding de values
                $request->bindParam(':idsConversation', $idConversation);

                // On execute
                $request->execute();
            }
        }
    }

    public static function getConversationsByIdAnnonce(PDO $connection, string $idAnnonce): string|false|null
    {
        // La requête
        $query = "select group_concat(con.con_id) as id_conversations from conversation con 
                                                    where con.ann_id = :idAnnonce";

        // On prépare la requête
        $request = $connection->prepare($query);

        // On fait le binding de values
        $request->bindParam(':idAnnonce', $idAnnonce);

        // On execute
        $request->execute();

        // On retourne le résultat
        return $request->fetchColumn();
    }

    public static function deleteConversations(PDO $connection, string $idAnnonce): void
    {
        // La requête
        $query = "delete from conversation where ann_id = :idAnnonce";

        // On prépare la requête
        $request = $connection->prepare($query);

        // On fait le binding de values
        $request->bindParam(':idAnnonce', $idAnnonce);

        // On execute
        $request->execute();
    }
}