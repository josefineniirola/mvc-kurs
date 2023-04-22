<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;

class DeckOfCards
{
    protected $cards;

    public function __construct()
    {
        $this->cards = [];
    }

    public function add(Card $card): void
    {
        $this->cards[] = $card;
    }

    public function generateDeck(): void
    {
        $suits = [
            ["suit" => "hearts"],
            ["suit" => "diamonds"],
            ["suit" => "clubs"],
            ["suit" => "spades"]
        ];

        $values = [
            ["value" => 1],
            ["value" => 2],
            ["value" => 3],
            ["value" => 4],
            ["value" => 5],
            ["value" => 6],
            ["value" => 7],
            ["value" => 8],
            ["value" => 9],
            ["value" => 10],
            ["value" => 11],
            ["value" => 12],
            ["value" => 13]
        ];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $card = new CardGraphic($value["value"], $suit["suit"]);
                $this->add($card);
            }
        }
    }


    public function wannabeDeck(array $deck): void
    {
        foreach ($deck as $cards) {
            $card = new CardGraphic($cards["num"], $cards["color"]);
            $this->add($card);
        }
    }

    public function getArray(): array
    {
        $deck = [];
        foreach ($this->cards as $card) {
            $deck[] = $card->getCard();
        }
        return $deck;
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function getNumberCards(): int
    {
        return count($this->cards);
    }

    public function drawACard(): array
    {
        $popped = [];
        $popped[] = array_pop($this->cards);
        return $popped;
    }
}
