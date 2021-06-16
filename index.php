<?php

use \Robot\Robot;
use \Robot\RobotFactory;
use \Robot\Robot1;
use \Robot\Robot2;
use \Robot\MergeRobot;

use \Robot\Robot3;

spl_autoload_register(function ($class) {
    require_once $class . '.php';
});

$firstRobotData = [
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

$secondRobotData = [
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

$thirdRobotData = [
    [
        'weight' => 555,
        'height' => 555,
        'speed'  => 555
    ],
    [
        'weight' => 999,
        'height' => 999,
        'speed'  => 999
    ],
    [
        'weight' => 888,
        'height' => 888,
        'speed'  => 888
    ],
    [
        'weight' => 777,
        'height' => 777,
        'speed'  => 777
    ]
];

$factory = new RobotFactory();

$factory->addType(new Robot1());
$factory->addType(new Robot2());

// $firstRobots = $factory->createRobot1(5, $firstRobotData);
$secondRobots = $factory->createRobot2(2, $secondRobotData);

$mergeRobot = new MergeRobot();
$mergeRobot->addRobot($secondRobots);

$result = $mergeRobot->configureRobot();

$factory->addType($mergeRobot);
echo sprintf(
    'Resulted robot: weight: %s, height: %s, speed: %s',
    $result->getWeight(),
    $result->getHeight(),
    $result->getSpeed()
);

$factory->addType(new Robot3());

$thirdRobots = $factory->createRobot3(4, $thirdRobotData);

$mergeRobot = new MergeRobot();
$mergeRobot->addRobot($thirdRobots);

$result = $mergeRobot->configureRobot();
$factory->addType($mergeRobot);

echo '<br>';
echo sprintf(
    'Resulted robot: weight: %s, height: %s, speed: %s',
    $result->getWeight(),
    $result->getHeight(),
    $result->getSpeed()
);