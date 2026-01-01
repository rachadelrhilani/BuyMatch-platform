<?php

class Order
{
    private int $id;
    private DateTime $dateCommande;
    private float $total;
    private array $tickets = [];

    public function __construct(int $id, DateTime $dateCommande)
    {
        $this->id = $id;
        $this->dateCommande = $dateCommande;
    }

    public function ajouterTicket(Ticket $ticket)
    {
        $this->tickets[] = $ticket;
    }
}
