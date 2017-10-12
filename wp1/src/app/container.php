<?php

namespace app;

use DI\ContainerBuilder;

//require_once "/vendor/autoload.php";

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$container = $containerBuilder->build();

return $container;