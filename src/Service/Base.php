<?php

namespace Stoa\Service;

use Doctrine\ORM\EntityManager;

abstract class Base
{
    /**
     * @var null|EntityManager
     */
    protected $entityManager = null;

    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = EntityManager::create($conn, $config);
        }

        return $this->entityManager;
    }
}
