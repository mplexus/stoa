<?php

declare(strict_types = 1);

namespace Stoa\Service;

use Stoa\Model\BaseModel;
use Stoa\Query\SearchEngine;
use Doctrine\ORM\EntityManager;
use Stoa\Core\Exception\ApplicationException;

abstract class Base
{
    /**
     * @var null|EntityManager
     */
    protected $entityManager = null;

    /**
     * @var SearchEngine
     */
    protected $searchEngine = null;

    public abstract function getResource() : string;

    /**
     * The default builders for the list action that is implemented in
     * the parent class.
     */
    public abstract function addListBuilders() : void;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
        $this->searchEngine = new SearchEngine($em, $this->entityManager->getRepository($this->getResource()));
    }

    /**
     * Retrieve the EntityManager.
     *
     * @return EntityManager
     */
    public function getEntityManager() : EntityManager
    {
        return $this->entityManager;
    }

    /**
     * Retrieve a single entity.
     * @return object|null
     */
    public function getItem($id) : ?BaseModel
    {
        if (!ctype_digit($id)) {
            return null;
        }

        return $this->entityManager->getRepository($this->getResource())->find($id);
    }

    /**
     * @return mixed
     */
    public function getList(array $criteria = []) : array
    {
        $this->addListBuilders();
        $query = $this->searchEngine->match($criteria);
        return $query->getResult();
    }

    /**
     * @return SearchEngine
     */
    public function getSearchEngine() : SearchEngine
    {
        return new SearchEngine($this->entityManager);
    }
}
