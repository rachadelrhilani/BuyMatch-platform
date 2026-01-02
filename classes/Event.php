<?php

class Event
{
    private int $id;
    private string $titre;
    private DateTime $date;
    private string $lieu;
    private int $duree;
    private string $statut;
    private Team $equipeDomicile;
    private Team $equipeExterieure;

    public function __construct(
        int $id,
        string $titre,
        DateTime $date,
        string $lieu,
        int $duree,
        string $statut,
        Team $domicile,
        Team $exterieure
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->duree = $duree;
        $this->statut = $statut;
        $this->equipeDomicile = $domicile;
        $this->equipeExterieure = $exterieure;
    }

    public function getId() { return $this->id; }
    public function getTitre() { return $this->titre; }
    public function getDate() { return $this->date; }
    public function getLieu() { return $this->lieu; }
    public function getStatut() { return $this->statut; }
    public function getEquipeDomicile() { return $this->equipeDomicile; }
    public function getEquipeExterieure() { return $this->equipeExterieure; }
}
