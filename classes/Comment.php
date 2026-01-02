<?php

class Comment
{
    private int $id;
    private string $contenu;
    private int $note;
    private string $statut;

    public function __construct(int $id, string $contenu, int $note, string $statut)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->note = $note;
        $this->statut = $statut;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }
}

