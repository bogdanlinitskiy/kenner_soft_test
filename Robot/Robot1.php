<?php

namespace Robot;

use Robot\Robot;

class Robot1 extends Robot
{
    public function getWeight(): int
    {
        return 321;
    }

    public function getHeight(): int
    {
        return 123;
    }

    public function getSpeed(): int
    {
        return 100;
    }
}