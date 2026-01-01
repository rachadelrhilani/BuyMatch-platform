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

    private array $categories = [];

    public function __construct(
        int $id,
        string $titre,
        DateTime $date,
        string $lieu,
        int $duree,
        Team $domicile,
        Team $exterieure
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->duree = $duree;
        $this->equipeDomicile = $domicile;
        $this->equipeExterieure = $exterieure;
    }

    public function publier() {}
    public function ajouterCategorie(Category $category) {}
}
