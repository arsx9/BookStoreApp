<?php

use DI\Container;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

//Add Container for dependency Injection
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../src/definitions.php');
$container = $containerBuilder->build();

//let Slim app know About this container
AppFactory::setContainer($container);
$app = AppFactory::create();

//Add Routes
require_once __DIR__ . '/../routes/api.php';

$app->run();
