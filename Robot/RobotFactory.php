<?php

namespace Robot;

use Robot\Robot;
use Robot\Robot1;
use Robot\Robot2;
use Robot\MergeRobot;

use Robot\Robot3;

class RobotFactory {
    private $robotTypes = [];

    public function addType(Robot $robotType): RobotFactory
    {
        $this->robotTypes[] = get_class($robotType);
        return $this;
    }

    // if we adding types to factory, then we need to control them
    private function checkRobotTypes($robotType): bool
    {
        if (in_array(get_class($robotType), $this->robotTypes)) {
            return true;
        } else {
            throw new \Exception('This type of robot is not supported by factory');
        }
    }

    /** 
     * numberOfRobots - number of robots to be added
     * robotFields - array of ['height', 'weight', 'speed] fields for each robot
    */
    public function createRobot1(int $numberOfRobots, array $robotFields): array
    {
        $this->checkRobotTypes(new Robot1());
        return $this->createRobots($numberOfRobots, $robotFields, get_class(new Robot1));
    }

    /** 
     * numberOfRobots - number of robots to be added
     * robotFields - array of ['height', 'weight', 'speed] fields for each robot
    */
    public function createRobot2($numberOfRobots, array $robotFields): array
    {
        $this->checkRobotTypes(new Robot2());
        return $this->createRobots($numberOfRobots, $robotFields, get_class(new Robot2));
    }

    /** 
     * numberOfRobots - number of robots to be added
     * robotFields - array of ['height', 'weight', 'speed] fields for each robot
    */
    public function createRobot3($numberOfRobots, array $robotFields): array
    {
        $this->checkRobotTypes(new Robot3());
        return $this->createRobots($numberOfRobots, $robotFields, get_class(new Robot3));
    }

    /** 
     * numberOfRobots - number of robots to be added
     * robotFields - array of ['height', 'weight', 'speed] fields for each robot
    */
    public function createMergeRobot($numberOfRobots, array $robotFields): array
    {
        $this->checkRobotTypes(new MergeRobot());
        return $this->createRobots($numberOfRobots, $robotFields, get_class(new MergeRobot));
    }

    private function createRobots(int $numberOfRobots, array $robotFields, $robotClass): array
    {
        if ($numberOfRobots !== count($robotFields)) {
            throw new \Exception('Number of robots to create must be equal to tobot fields');
        } else {
            foreach($robotFields as $oneRobotFields) {
                $robot = new $robotClass();
                $robot->setWeight($oneRobotFields['weight']);
                $robot->setHeight($oneRobotFields['height']);
                $robot->setSpeed($oneRobotFields['speed']);
    
                $arrayOfRobots[] = $robot;
            }
        }
        
        return $arrayOfRobots;
    }
}