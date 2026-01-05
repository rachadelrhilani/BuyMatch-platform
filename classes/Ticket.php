<?php

class Ticket
{
    private int $id;
    private string $numero;
    private string $place;

    public function __construct(int $id, string $numero, string $place, string $qrCode)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->place = $place;
    }
    
}
