<?php

namespace Stoa\Query;

use DateTime;
use Stoa\Query\Builder;
use Doctrine\ORM\QueryBuilder;

class DateBuilder implements Builder
{
    private $field = null;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function supports(array $criteria)
    {
        return isset($criteria['dateFrom']) && isset($criteria['dateTo']);
    }

    public function build(array $criteria, QueryBuilder $queryBuilder)
    {
        $start = $criteria['dateFrom'];
        $end = $criteria['dateTo'];

        if (empty($start) || empty($end)) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];

        $queryBuilder->andWhere($alias . '.' . $this->field . ' >= :start')
            ->andWhere($alias . '.' . $this->field . ' <= :end')
            ->setParameter(':start', $this->format($start))
            ->setParameter(':end', $this->format($end));
    }

    private function format($date)
    {
        $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

        return $datetime->format('Y-m-d H:i:s');
    }
}