<?php

namespace Robot;

use Robot\Robot;
use Robot\Robot1;
use Robot\Robot2;
use Robot\MergeRobot;

use Robot\Robot3;

class RobotFactory
{
    private $robotTypes = [];

    public function addType(Robot $robot): RobotFactory
    {
        array_push($this->robotTypes, ($robot));
        return $this;
    }

    // if we adding types to factory, then we need to control them
    private function checkRobotTypes($robotType): bool
    {
        foreach ($this->robotTypes as $type) {
            $robotReflection = new \ReflectionClass($type);
            if ($robotReflection->getShortName() === $robotType) {
                return true;
            }
        }

        throw new \Exception('This type of robot is not supported by factory');
    }

    // refactor to createRobotN handler
    public function __call($name, $arguments)
    {
        $method = substr($name, 0, 6);
        if ($method !== 'create') {
            throw new \Exception('This method is not allowed here');
        }
        
        $robotClass = substr($name, 6);
        $numberOfRobots = $arguments[0];

        $this->checkRobotTypes($robotClass);
        if (!is_integer($numberOfRobots) || $numberOfRobots <= 0) {
            throw new \InvalidArgumentException('Wrong count number');
        }
        return $this->createRobots($numberOfRobots, $robotClass);
    }   

    private function createRobots(int $numberOfRobots, string $robotClass)
    {
        $this->checkRobotTypes($robotClass);
        $result = [];
        for ($i = 0; $i < $numberOfRobots; $i++) {
            foreach ($this->robotTypes as $robot) {
                $robotReflection = new \ReflectionClass($robot);
                if ($robotReflection->getShortName() === $robotClass) {
                    $result[] = clone $robot;
                }
            }
        }
        return $result;
    }

    public function getRobotTypes()
    {
        return $this->robotTypes;
    }
}