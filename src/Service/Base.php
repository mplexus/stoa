<?php

namespace Stoa\Service;

use Doctrine\ORM\EntityManager;

abstract class Base
{
    /**
     * @var null|EntityManager
     */
    protected $entityManager = null;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
