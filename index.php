<?php

abstract class Robot {
    private $weight;
    private $height;
    private $speed;


    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    public function getHeight()
    {
        
    }

    public function setHeight(int $height)
    {
        $this->height = $height;
    }

    public function getSpeed()
    {
        
    }

    public function setSpeed(int $speed)
    {
        $this->speed = $speed;
    }
}

class Robot1 extends Robot {
}

class Robot2 extends Robot {
}

class MergeRobot extends Robot
{
    private $robots;

    // change logic
    public function addRobot($robots)
    {
        $this->robots = $robots;
    }

    public function configureRobot()
    {
        foreach ($this->robots as $robot) {
            $heightSum += $robot->getHeight();
            $weightSum += $robot->getWeight();
            $speed = $robot->getSpeed() < $speed ? $robot->getSpeed() : $speed;
        }

        echo '<br>' . $heightSum . ' ' . $weightSum . ' ' . $speed;
    }
}

class RobotFactory {
    private $robotTypes = [];

    public function addType(Robot $robotType): RobotFactory
    {
        $this->robotTypes[] = get_class($robotType);
        return $this;
    }

    // make private after tests
    public function checkRobotTypes($robotType): bool
    {
        if (in_array(get_class($robotType), $this->robotTypes)) {
            return true;
        } else {
            throw new Exception('This type of robot is not supported by factory');
        }
    }

    /** 
     * numberOfRobots - number of robots to be added
     * robotFields - array of ['height', 'weight', 'speed] fields for each robot
     */
    // add Exception
    public function createRobot1(int $numberOfRobots, array $robotFields): array
    {
        return $this->createRobots($numberOfRobots, $robotFields, get_class(new Robot1));
    }

    public function createRobot2($numberOfRobots, array $robotFields): array
    {
        return $this->createRobots($numberOfRobots, $robotFields, get_class(new Robot2));
    }

    public function createMergeRobot($numberOfRobots, array $robotFields): array
    {
        return $this->createRobots($numberOfRobots, $robotFields, get_class(new MergeRobot));
    }

    private function createRobots(int $numberOfRobots, array $robotFields, $robotClass): array
    {
        if ($numberOfRobots !== count($robotFields)) {
            throw new Exception('Number of robots to create must be equal to tobot fields');
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

$factory = new RobotFactory();

$factory->addType(new Robot1());
$factory->addType(new Robot2());

$firstRobotFields = [
    [
        'weight' => 123,
        'height' => 124,
        'speed'  => 125
    ],
    [
        'weight' => 222,
        'height' => 223,
        'speed'  => 224
    ],
    [
        'weight' => 333,
        'height' => 334,
        'speed'  => 335
    ],
    [
        'weight' => 444,
        'height' => 445,
        'speed'  => 446
    ],
    [
        'weight' => 555,
        'height' => 556,
        'speed'  => 557
    ]
];


$secondRobotFields = [
    [
        'weight' => 1000,
        'height' => 1001,
        'speed'  => 1002
    ],
    [
        'weight' => 100,
        'height' => 101,
        'speed'  => 400
    ]
];

$firstRobots = $factory->createRobot1(5, $firstRobotFields);
$secondRobots = $factory->createRobot2(2, $secondRobotFields);

var_dump($firstRobots);
var_dump($secondRobots);

$mergeRobot = new MergeRobot();
$mergeRobot->addRobot($secondRobots);
$mergeRobot->configureRobot();
$factory->addType($mergeRobot);
// $res = reset($factory->createMergeRobot(1));
// var_dump($a);