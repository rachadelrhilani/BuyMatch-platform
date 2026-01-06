<?php

class Order
{
    private int $id;
    private int $acheteurId;
    private float $total;
    private array $tickets = [];

    public function __construct(int $id, int $acheteurId, float $total)
    {
        $this->id = $id;
        $this->acheteurId = $acheteurId;
        $this->total = $total;
    }
    public function getId() { return $this->id; }
    public function getTotal() { return $this->total; }

    public function addTicket(Ticket $ticket): void
    {
        $this->tickets[] = $ticket;
    }

    public function getTickets(): array
    {
        return $this->tickets;
    }
}
