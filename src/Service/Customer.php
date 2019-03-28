<?php

namespace Stoa\Service;

use Doctrine\ORM\EntityManager;

class Customer extends Base
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function getTotals()
    {
        $entityManager = $this->getEntityManager();
        $customers = $entityManager->getRepository('Stoa\Model\Customer')->findAll();

        return count($customers);
    }

    public function findAll()
    {
        $entityManager = $this->getEntityManager();
        $customers = $entityManager->getRepository('Stoa\Model\Customer')->findAll();

        return $customers;
    }
}
