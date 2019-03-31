<?php

namespace Stoa\Service;

use Stoa\Query\SearchEngine;
use Doctrine\ORM\EntityManager;

abstract class Base
{
    /**
     * @var null|EntityManager
     */
    protected $entityManager = null;

    protected $searchEngine = null;

    abstract function getResource();

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
        $this->searchEngine = new SearchEngine($this->entityManager->getRepository($this->getResource()));
        $this->addBuilders();
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

    public function getList(array $criteria = [])
    {
        return $this->searchEngine->match($criteria);
    }
}
