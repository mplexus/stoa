<?php

require_once __DIR__.'/../src/bootstrap.php';

use Stoa\Service\Command as CommandService;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

$loader = new Loader();
$loader->loadFromDirectory(__DIR__.'/../data/fixtures');
$purger = new ORMPurger();
$service = new CommandService();
$executor = new ORMExecutor($service->getEntityManager(), $purger);
$executor->execute($loader->getFixtures());
