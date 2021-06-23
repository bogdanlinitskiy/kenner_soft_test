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

$factory = new RobotFactory();

$factory->addType(new Robot1());
$factory->addType(new Robot2());
$factory->createRobot1(5);
$factory->createRobot2(2);

$mergeRobot = new MergeRobot();
$mergeRobot->addRobot(new Robot2());
$mergeRobot->addRobot($factory->createRobot2(2));

$factory->addType($mergeRobot);

$res = reset($factory->createMergeRobot(1));

echo 'weight: ' . $res->getWeight() . '<br>';
echo 'height: ' . $res->getheight() . '<br>';
echo 'speed: ' . $res->getSpeed();
