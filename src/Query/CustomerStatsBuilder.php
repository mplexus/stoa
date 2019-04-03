<?php

declare(strict_types = 1);

namespace Stoa\Query;

use Stoa\Query\Builder;
use Doctrine\ORM\QueryBuilder;

class CustomerStatsBuilder implements Builder
{
    /**
     * @inheritdoc
     */
    public function supports(array $criteria) : bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function build(array $criteria, QueryBuilder $queryBuilder) : void
    {
        $queryBuilder->select('CONCAT(CONCAT(c.first_name, \' \'), c.last_name) as name, COUNT(o.id) as quantity')
            ->from('Stoa\Model\Order', 'o')
            ->leftJoin('o.customer', 'c')
            ->groupBy('c.id')
            ;
    }
}
