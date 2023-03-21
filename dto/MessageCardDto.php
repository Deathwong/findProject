<?php

namespace dto;

class MessageCardDto
{
    private int $receiverId;
    private int $idAnnonce;
    private string $receiver;
    private string $nomAnnonce;
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

    private string $message;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getReceiverId(): string
    {
        return $this->receiverId;
    }

    /**
     * @param string $receiverId
     */
    public function setReceiverId(string $receiverId): void
    {
        $this->receiverId = $receiverId;
    }

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @param string $receiver
     */
    public function setReceiver(string $receiver): void
    {
        $this->receiver = $receiver;
    }

    /**
     * @return string
     */
    public function getIdAnnonce(): string
    {
        return $this->idAnnonce;
    }

    /**
     * @param string $idAnnonce
     */
    public function setIdAnnonce(string $idAnnonce): void
    {
        $this->idAnnonce = $idAnnonce;
    }

    /**
     * @return string
     */
    public function getNomAnnonce(): string
    {
        return $this->nomAnnonce;
    }

    /**
     * @param string $nomAnnonce
     */
    public function setNomAnnonce(string $nomAnnonce): void
    {
        $this->nomAnnonce = $nomAnnonce;
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

}