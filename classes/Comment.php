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
}
