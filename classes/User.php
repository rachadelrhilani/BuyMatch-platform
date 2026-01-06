<?php

abstract class User
{
    protected int $id;
    protected string $nom;
    protected string $email;
    protected string $telephone;
    protected string $photo;
    protected string $password;

    public function __construct($id, $nom, $email,$telephone,$photo, $password)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone= $telephone;
        $this->photo= $photo;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }
}
