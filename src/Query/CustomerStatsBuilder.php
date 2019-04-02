<?php

namespace Stoa\Query;

use Stoa\Query\Builder;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

class CustomerStatsBuilder implements Builder
{
    public function supports(array $criteria)
    {
        return true;
    }

    public function build(array $criteria, QueryBuilder $queryBuilder)
    {
        $queryBuilder->select('CONCAT(CONCAT(c.first_name, \' \'), c.last_name), COUNT(o.id) as quantity')
            ->from('Stoa\Model\Order', 'o')
            ->leftJoin('o.customer', 'c', Expr\Join::WITH)
            ->groupBy('c.id')
            ;
    }
}
