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
        $type = isset($criteria['type']) ? $criteria['type'] : null;
        $format = '';

        switch ($type) {
            case 'month':
                $format = "%Y-%m";
                break;
            case 'year':
                $format = "%Y";
                break;
            case 'day':
            default:
                $format = "%Y-%m-%d";
                break;
        }

        $queryBuilder->select('DATE_FORMAT(o.purchaseDate, \''.$format.'\') as date, COUNT(DISTINCT c.id) as customers, COUNT(o.id) as quantity')
            ->from('Stoa\Model\Order', 'o')
            ->leftJoin('o.customer', 'c')
            ->groupBy('date')
            ->orderBy('date')
            ;
    }
}
