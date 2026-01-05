<?php

class Ticket
{
    private int $id;
    private string $numero;
    private string $place;
    private int $categoryId;

    public function __construct(
        int $id,
        string $numero,
        string $place,
        int $categoryId
    ) {
        $this->id = $id;
        $this->numero = $numero;
        $this->place = $place;
        $this->categoryId = $categoryId;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getNumero(): string { return $this->numero; }
    public function getPlace(): string { return $this->place; }
    public function getCategoryId(): int { return $this->categoryId; }
}
