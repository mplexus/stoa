<?php

declare(strict_types = 1);

namespace Stoa\Query;

use Stoa\Query\Builder;
use Doctrine\ORM\QueryBuilder;

class DateGroupingBuilder implements Builder
{
    /**
     * @inheritdoc
     */
    public function supports(array $criteria) : bool
    {
        return isset($criteria['type']) &&
            in_array($criteria['type'], ['day', 'month', 'year']);
    }

    /**
     * @inheritdoc
     */
    public function build(array $criteria, QueryBuilder $queryBuilder) : void
    {
        $alias = $queryBuilder->getRootAliases()[0];

        if ($criteria['type'] == 'day') {
            $queryBuilder
                ->addSelect('DATE_FORMAT('.$alias.'.purchaseDate,"%Y-%m-%d") as date')
                ->addGroupBy('date')
                ->addOrderBy('date', 'ASC');

            return;
        }

        if ($criteria['type'] == 'month') {
            $queryBuilder
                ->addSelect('DATE_FORMAT('.$alias.'.purchaseDate,"%Y-%m") as date')
                ->addGroupBy('date')
                ->addOrderBy('date', 'ASC');

            return;
        }

        $queryBuilder
            ->addSelect('DATE_FORMAT('.$alias.'.purchaseDate, "%Y") as date')
            ->addGroupBy('date')
            ->addOrderBy('date', 'ASC');
    }
}
