<?php

namespace dto;

class ConversationCard
{
    private int $idConversation;
    private int $annonceId;
    private string $annonceNom;
    private int $acheteurId;
    private string $acheteurEmail;
    private int $vendeurId;
    private string $vendeurEmail;
    private int $messageId;
    private string $message;
    private string $photo;

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    private string $date;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdConversation(): int
    {
        return $this->idConversation;
    }

    /**
     * @param int $idConversation
     */
    public function setIdConversation(int $idConversation): void
    {
        $this->idConversation = $idConversation;
    }

    /**
     * @return int
     */
    public function getAnnonceId(): int
    {
        return $this->annonceId;
    }

    /**
     * @param int $annonceId
     */
    public function setAnnonceId(int $annonceId): void
    {
        $this->annonceId = $annonceId;
    }

    /**
     * @return string
     */
    public function getAnnonceNom(): string
    {
        return $this->annonceNom;
    }

    /**
     * @param string $annonceNom
     */
    public function setAnnonceNom(string $annonceNom): void
    {
        $this->annonceNom = $annonceNom;
    }

    /**
     * @return int
     */
    public function getAcheteurId(): int
    {
        return $this->acheteurId;
    }

    /**
     * @param int $acheteurId
     */
    public function setAcheteurId(int $acheteurId): void
    {
        $this->acheteurId = $acheteurId;
    }

    /**
     * @return string
     */
    public function getAcheteurEmail(): string
    {
        return $this->acheteurEmail;
    }

    /**
     * @param string $acheteurEmail
     */
    public function setAcheteurEmail(string $acheteurEmail): void
    {
        $this->acheteurEmail = $acheteurEmail;
    }

    /**
     * @return int
     */
    public function getVendeurId(): int
    {
        return $this->vendeurId;
    }

    /**
     * @param int $vendeurId
     */
    public function setVendeurId(int $vendeurId): void
    {
        $this->vendeurId = $vendeurId;
    }

    /**
     * @return string
     */
    public function getVendeurEmail(): string
    {
        return $this->vendeurEmail;
    }

    /**
     * @param string $vendeurEmail
     */
    public function setVendeurEmail(string $vendeurEmail): void
    {
        $this->vendeurEmail = $vendeurEmail;
    }

    /**
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     */
    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}