<?php

class Category
{
    private int $id;
    private string $nom;
    private float $prix;
    private int $capacite;

    public function __construct(int $id, string $nom, float $prix,int $capacite)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->capacite = $capacite;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getCapacite(): string
    {
        return $this->capacite;
    }
    public function getPrix(): float
    {
        return $this->prix;
    }
}

