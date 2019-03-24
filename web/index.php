<?php

require_once __DIR__ . '/../src/bootstrap.php';

use Stoa\Controller\IndexController;

$controller = new IndexController();
$controller->invoke();
