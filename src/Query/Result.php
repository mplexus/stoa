<?php

namespace Stoa\Query;

use Doctrine\ORM\QueryBuilder;

class Result
{
    private $queryBuilder;

    /**
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getResult()
    {
        return $this->queryBuilder->getQuery()->getResult();
    }

    public function getScalarResult()
    {
        return $this->queryBuilder->getQuery()->getScalarResult();
    }
}
