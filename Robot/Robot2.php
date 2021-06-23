<?php

namespace Robot;

use Robot\Robot;

class Robot2 extends Robot
{
    public function getHeight(): int
    {
        return 222;
    }

    public function getWeight(): int
    {
        return 333;
    }

    public function getSpeed(): int
    {
        return 100;
    }
}