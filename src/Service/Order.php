<?php

namespace Stoa\Service;

use Doctrine\ORM\EntityManager;

class Order extends Base
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function getTotals()
    {
        $entityManager = $this->getEntityManager();
        $orders = $entityManager->getRepository('Stoa\Model\Order')->findAll();

        return count($orders);
    }
}
