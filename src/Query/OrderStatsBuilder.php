<?php

declare(strict_types = 1);

namespace Stoa\Query;

use Stoa\Query\Builder;
use Doctrine\ORM\QueryBuilder;

class OrderStatsBuilder implements Builder
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
        $queryBuilder->select('COUNT(o.id) as quantity')
            ->addSelect('SUM(i.price) as revenue')
            ->from('Stoa\Model\Order', 'o')
            ->leftJoin('o.orderItems', 'i')
            ;
    }
}
