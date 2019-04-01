<?php

namespace Stoa\Query;

use DateTime;
use Stoa\Query\Builder;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

class OrderStatsBuilder implements Builder
{
    public function supports(array $criteria)
    {
        return true;
    }

    public function build(array $criteria, QueryBuilder $queryBuilder)
    {
        $queryBuilder->select('COUNT(o.id) as quantity')
            ->addSelect('SUM(i.price) as revenue')
            ->from('Stoa\Model\Order', 'o')
            ->leftJoin('o.orderItems', 'i',Expr\Join::WITH)
            ;
    }
}
