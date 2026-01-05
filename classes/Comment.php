<?php

class Comment
{
    private int $id;
    private string $contenu;
    private int $note;
    private string $statut;
    private ?string $eventTitre = null;
    private ?string $createdAt = null;

    public function __construct(
        int $id,
        string $contenu,
        int $note,
        string $statut,
        ?string $eventTitre = null,
        ?string $createdAt = null
    ) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->note = $note;
        $this->statut = $statut;
        $this->eventTitre = $eventTitre;
        $this->createdAt = $createdAt;
    }

    public function getContenu(): string { return $this->contenu; }
    public function getNote(): int { return $this->note; }
    public function getEventTitre(): ?string { return $this->eventTitre; }
    public function getCreatedAt(): ?string { return $this->createdAt; }
}

