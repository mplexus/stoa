<?php

namespace Stoa\Service;

use Doctrine\ORM\EntityManager;
use Stoa\Model\Customer as CustomerModel;

class Customer extends Base
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function getTotals()
    {
        $entityManager = $this->getEntityManager();
        $customers = $entityManager->getRepository($this->getResource())->findAll();

        return count($customers);
    }

    public function getResource()
    {
        return CustomerModel::class;
    }

    public function addBuilders()
    {
    }
}
