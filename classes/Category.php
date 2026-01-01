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
}
