<?php

namespace Stoa\Service;

use Doctrine\ORM\EntityManager;

abstract class Base
{
    /**
     * @var null|EntityManager
     */
    protected $entityManager = null;

    abstract function getResource();

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getItem($id)
    {
        $criteria = ['id' => $id];

        return $this->entityManager->getRepository($this->getResource())->findOneById($criteria);
    }

    public function getList()
    {
        return $this->entityManager->getRepository($this->getResource())->findAll();
    }
}
