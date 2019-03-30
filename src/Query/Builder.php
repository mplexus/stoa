<?php

namespace Stoa\Query;

use Doctrine\ORM\QueryBuilder;

interface Builder
{
    /**
     * Checks if current builder supports given criteria.
     *
     * @param array $criteria
     * @return bool
     */
    public function supports(array $criteria);

    /**
     * Apply criteria to given query builder.
     *
     * @param array $criteria
     * @param QueryBuilder $queryBuilder
     * @return void
     */
    public function build(array $criteria, QueryBuilder $queryBuilder);
}
