<?php

namespace App\Card;

use App\Card\Card;

class CardGraphic extends Card
{
    private $representation = [
        ['value' => '&#127153;', 'color' => 'hearts', 'order' => 1],
        ['value' => '&#127154;', 'color' => 'hearts', 'order' => 2],
        ['value' => '&#127155;', 'color' => 'hearts', 'order' => 3],
        ['value' => '&#127156;', 'color' => 'hearts', 'order' => 4],
        ['value' => '&#127157;', 'color' => 'hearts', 'order' => 5],
        ['value' => '&#127158;', 'color' => 'hearts', 'order' => 6],
        ['value' => '&#127159;', 'color' => 'hearts', 'order' => 7],
        ['value' => '&#127160;', 'color' => 'hearts', 'order' => 8],
        ['value' => '&#127161;', 'color' => 'hearts', 'order' => 9],
        ['value' => '&#127162;', 'color' => 'hearts', 'order' => 10],
        ['value' => '&#127163;', 'color' => 'hearts', 'order' => 11],
        ['value' => '&#127165;', 'color' => 'hearts', 'order' => 12],
        ['value' => '&#127166;', 'color' => 'hearts', 'order' => 13],
        ['value' => '&#127169;', 'color' => 'diamonds', 'order' => 1],
        ['value' => '&#127170;', 'color' => 'diamonds', 'order' => 2],
        ['value' => '&#127171;', 'color' => 'diamonds', 'order' => 3],
        ['value' => '&#127172;', 'color' => 'diamonds', 'order' => 4],
        ['value' => '&#127173;', 'color' => 'diamonds', 'order' => 5],
        ['value' => '&#127174;', 'color' => 'diamonds', 'order' => 6],
        ['value' => '&#127175;', 'color' => 'diamonds', 'order' => 7],
        ['value' => '&#127176;', 'color' => 'diamonds', 'order' => 8],
        ['value' => '&#127177;', 'color' => 'diamonds', 'order' => 9],
        ['value' => '&#127178;', 'color' => 'diamonds', 'order' => 10],
        ['value' => '&#127179;', 'color' => 'diamonds', 'order' => 11],
        ['value' => '&#127181;', 'color' => 'diamonds', 'order' => 12],
        ['value' => '&#127182;', 'color' => 'diamonds', 'order' => 13],
        ['value' => '&#127137;', 'color' => 'spades', 'order' => 1],
        ['value' => '&#127138;', 'color' => 'spades', 'order' => 2],
        ['value' => '&#127139;', 'color' => 'spades', 'order' => 3],
        ['value' => '&#127140;', 'color' => 'spades', 'order' => 4],
        ['value' => '&#127141;', 'color' => 'spades', 'order' => 5],
        ['value' => '&#127142;', 'color' => 'spades', 'order' => 6],
        ['value' => '&#127143;', 'color' => 'spades', 'order' => 7],
        ['value' => '&#127144;', 'color' => 'spades', 'order' => 8],
        ['value' => '&#127145;', 'color' => 'spades', 'order' => 9],
        ['value' => '&#127146;', 'color' => 'spades', 'order' => 10],
        ['value' => '&#127147;', 'color' => 'spades', 'order' => 11],
        ['value' => '&#127149;', 'color' => 'spades', 'order' => 12],
        ['value' => '&#127150;', 'color' => 'spades', 'order' => 13],
        ['value' => '&#127185;', 'color' => 'clubs', 'order' => 1],
        ['value' => '&#127186;', 'color' => 'clubs', 'order' => 2],
        ['value' => '&#127187;', 'color' => 'clubs', 'order' => 3],
        ['value' => '&#127188;', 'color' => 'clubs', 'order' => 4],
        ['value' => '&#127189;', 'color' => 'clubs', 'order' => 5],
        ['value' => '&#127190;', 'color' => 'clubs', 'order' => 6],
        ['value' => '&#127191;', 'color' => 'clubs', 'order' => 7],
        ['value' => '&#127192;', 'color' => 'clubs', 'order' => 8],
        ['value' => '&#127193;', 'color' => 'clubs', 'order' => 9],
        ['value' => '&#127194;', 'color' => 'clubs', 'order' => 10],
        ['value' => '&#127195;', 'color' => 'clubs', 'order' => 11],
        ['value' => '&#127197;', 'color' => 'clubs', 'order' => 12],
        ['value' => '&#127198;', 'color' => 'clubs', 'order' => 13]
    ];

    protected $graphic;

    public function __construct($num, $color)
    {
        parent::__construct($num, $color);
        $count = count($this->representation);
        for ($i = 0; $i < $count; $i++) {
            if ($this->representation[$i]["order"] == $this->num && $this->representation[$i]["color"] == $this->color) {
                $this->graphic = $this->representation[$i]["value"];
            }
        }
    }

    public function getCard(): array
    {
        return ["num" => $this->num, "color" => $this->color, "graphic" => $this->graphic];
    }
}
