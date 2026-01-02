<?php

class Category
{
    private int $id;
    private string $nom;
    private float $prix;

    public function __construct(int $id, string $nom, float $prix)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }
}

