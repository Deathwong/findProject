<?php

namespace dto;

class MessageCard
{
    private string $receiver;
    private string $nomAnnonce;
    private string $message;

    public function __construct()
    {
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