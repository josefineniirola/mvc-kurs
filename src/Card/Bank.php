<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardHand;

class Bank
{
    private $hand;
    private $score;

    public function __construct(CardHand $cardHand)
    {
        $this->hand = $cardHand;
        $this->score = 0;
    }

    // public function addCardHand()
    // {
    //     return $this->hand;
    // }

    public function getCardHand()
    {
        return $this->hand;
    }
    
    public function getScore(): int
    {
        return $this->score;
    }

    public function calculateScore(): void
    {
        $this->score = $this->hand->countCards();
    }

    public function checkIfBusted(): bool
    {
        return $this->hand->countCards() > 21;
    }

}
