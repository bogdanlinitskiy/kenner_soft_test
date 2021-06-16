<?php

namespace Robot;

use Robot\Robot;

class MergeRobot extends Robot
{
    private $robotsToMerge = [];

    // change logic
    public function addRobot($robots): self
    {
        if (is_array($robots)) {
            $this->robotsToMerge = array_merge($this->robotsToMerge, $robots);
        } elseif($robots instanceof Robot && count($robots) == 1) {
            $this->robotsToMerge[] = $robots;
        } else {
            throw new \Exception('Robots should be instance of Robot or array');
        }

        return $this;
    }

    public function configureRobot(): self
    {
        foreach ($this->robotsToMerge as $robot) {
            $weightSum += $robot->getWeight();
            $heightSum += $robot->getHeight();
            $speed = !isset($speed) ? $robot->getSpeed()
            : $robot->getSpeed() < $speed
            ? $robot->getSpeed()
            : $speed;
        }

        $mergeRobot = new MergeRobot();
        $mergeRobot->setWeight($weightSum);
        $mergeRobot->setHeight($heightSum);
        $mergeRobot->setSpeed($speed);

        return $mergeRobot;
    }
}