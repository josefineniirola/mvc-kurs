<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    private $cards = [];

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    public function addCard(array $card)
    {
        $this->cards[] = $card;
    }

    public function getCards(): array
    {
        return $this->cards;
    }
}
