<?php

namespace Models;

class Food
{
    public $title;
    public $price;
    public $pic;
    public $description;

    public function __construct(string $title, int $price, string $pic, string $description)
    {
        $this->title = $title;
        $this->price = $price;
        $this->pic = $pic;
        $this->description = $description;
    }
}
?>