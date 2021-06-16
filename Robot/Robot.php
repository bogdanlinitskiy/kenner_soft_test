<?php

namespace Robot;

abstract class Robot {
    private $weight;
    private $height;
    private $speed;


    public function getWeight(): int
    {
        return (int)$this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = (int)$weight;
        return $this;
    }

    public function getHeight(): int
    {
        return (int)$this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = (int)$height;
        return $this;
    }

    public function getSpeed(): int
    {
        return (int)$this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = (int)$speed;
        return $this;
    }
}