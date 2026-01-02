<?php

class Organisateur extends User
{
    public function creerEvenement(array $data): bool
    {
        $repo = new EventRepository();
        return $repo->createEvent($data, $this->id);
    }

    public function modifierEvenement(int $eventId, array $data): bool
    {
        $repo = new EventRepository();
        return $repo->updateEvent($eventId, $this->id, $data);
    }

    public function consulterStatistiques(): array
    {
        $repo = new EventRepository();
        return $repo->getStatsByOrganisateur($this->id);
    }

    public function voirCommentaires(): array
    {
        $repo = new EventRepository();
        return $repo->getCommentairesByOrganisateur($this->id);
    }
}

