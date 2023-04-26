<?php

namespace App\Card;

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

    public function countCards() {
        $countCards = [];
        $cards = $this->cards;
        foreach ($cards as $card) {
            $countCards[] = $card["num"];
        }
        $sumOfCards = array_sum($countCards);
        return $sumOfCards;
    }

    public function checkIfTwentyOne(): bool {
        $win = True;

        if ($this->countCards() > 21) {
            $win = False;
        }

        if ($this->countCards() == 21) {
            $win = True;
        }

        // if ($this->countCards() < 21) {
        //     $win = False;
        // }

        return $win;
    }
}
