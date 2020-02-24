<?php

// Используем PSR-O, для именования пространства используем название пути к конкретному классу
namespace vendor\lib_2;

class User
{
    private $id = 50;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}