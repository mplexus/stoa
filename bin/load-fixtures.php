<?php

require_once __DIR__.'/../src/bootstrap.php';

use Stoa\Service\Command as CommandService;
use Stoa\Service\Order as OrderService;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

echo "Loading fixtures...";
try {
    $loader = new Loader();
    $loader->loadFromDirectory(__DIR__.'/../data/fixtures');
    $purger = new ORMPurger();
    $entityManager = $bootstrap['entity_manager'];
    $executor = new ORMExecutor($entityManager, $purger);
    $executor->execute($loader->getFixtures());
    echo "Done.\n";
} catch (\Exception $e) {
    echo "Failed: ";
    echo $e->getMessage() ."\n";
}
