<?php

// Используем PSR-O, для именования пространства используем название пути к конкретному классу
namespace vendor\lib_1;

class User
{
    private $id = 100;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}

function infoUser()
{
    return __FUNCTION__;
}
