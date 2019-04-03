<?php

declare(strict_types = 1);

namespace Stoa\Service;

use Doctrine\ORM\EntityManager;
use Stoa\Model\Customer as CustomerModel;

class Customer extends Base
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    /**
     * @return int
     */
    public function getTotals() : int
    {
        $entityManager = $this->getEntityManager();
        $customers = $entityManager->getRepository($this->getResource())->findAll();

        return count($customers);
    }

    /**
     * @return string
     */
    public function getResource() : string
    {
        return CustomerModel::class;
    }

    /**
     * @inheritdoc
     */
    public function addListBuilders() : void
    {
    }
}
