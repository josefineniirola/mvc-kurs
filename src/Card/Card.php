<?php

namespace App\Card;

class Card
{
    protected $num;
    protected $color;

    public function __construct($num, $color)
    {
        $this->num = $num;
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getNum()
    {
        return $this->num;
    }

    public function getCard(): array
    {
        return "[{$this->num}, {$this->color}]";
    }
}
