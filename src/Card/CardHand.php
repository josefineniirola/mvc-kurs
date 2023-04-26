<?php

namespace App\Card;

class CardHand
{
    private $cards;

    public function __construct()
    {
        $this->cards = [];
    }

    public function addCard(CardGraphic $card)
    {
        $this->cards[] = $card;
    }

    public function getCards()
    {
        return $this->cards;
    }

    public function getArray(): array
    {
        $deck = [];
        foreach ($this->cards as $card) {
            $deck[] = $card->getCard();
        }
        return $deck;
    }

    public function countCards() {
        $countCards = [];
        $cards = $this->cards;
        foreach ($cards as $card) {
            $countCards[] = $card->getNum();
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
