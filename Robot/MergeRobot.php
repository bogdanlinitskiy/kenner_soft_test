<?php

namespace Robot;

use Robot\Robot;

class MergeRobot extends Robot
{
    private $robotsToMerge = [];

    public function addRobot($robots): self
    {
        if (is_array($robots)) {
            $this->robotsToMerge = array_merge($this->robotsToMerge, $robots);
        } elseif (count($robots) == 1 && $robots instanceof Robot) {
            $this->robotsToMerge[] = $robots;
        } else {
            throw new \Exception('Robots should be instance of Robot or array');
        }

        return $this;
    }

    public function getRobotsToMerge(): array
    {
        return $this->robotsToMerge;
    }

    public function getWeight(): int
    {
        return array_sum(array_map(function ($robot) {
            return $robot->getWeight();
        }, $this->robotsToMerge));
    }

    public function getHeight(): int
    {
        return array_sum(array_map(function ($robot) {
            return $robot->getHeight();
        }, $this->robotsToMerge));
    }

    public function getSpeed(): int
    {
        return min(array_map(function ($robot) {
            return $robot->getSpeed();
        }, $this->robotsToMerge));
    }
}