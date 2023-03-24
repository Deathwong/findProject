<?php

namespace dto;

class MessageCardDto
{
    private int $interlocuteurId;
    private int $idAnnonce;
    private string $interlocuteur;
    private string $message;
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

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getInterlocuteurId(): string
    {
        return $this->interlocuteurId;
    }

    /**
     * @param string $interlocuteurId
     */
    public function setInterlocuteurId(string $interlocuteurId): void
    {
        $this->interlocuteurId = $interlocuteurId;
    }

    /**
     * @return string
     */
    public function getInterlocuteur(): string
    {
        return $this->interlocuteur;
    }

    /**
     * @param string $interlocuteur
     */
    public function setInterlocuteur(string $interlocuteur): void
    {
        $this->interlocuteur = $interlocuteur;
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