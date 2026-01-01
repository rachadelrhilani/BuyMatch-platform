<?php

class Acheteur extends User
{
    public function acheterBillet(Event $event, Category $category) {}
    public function consulterHistorique() {}
    public function laisserCommentaire(Event $event, string $contenu, int $note) {}
}
