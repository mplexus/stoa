<?php

declare(strict_types = 1);

namespace Stoa\Query;

use DateTime;
use Stoa\Query\Builder;
use Doctrine\ORM\QueryBuilder;

class DateBuilder implements Builder
{
    /**
     * @var string
     */
    private $field = null;

    /**
     * @param string
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * @inheritdoc
     */
    public function supports(array $criteria) : bool
    {
        return isset($criteria['date_from']) && isset($criteria['date_to']);
    }

    /**
     * @inheritdoc
     */
    public function build(array $criteria, QueryBuilder $queryBuilder) : void
    {
        $start = $criteria['date_from'];
        $end = $criteria['date_to'];

        if (empty($start) || empty($end)) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];

        $queryBuilder->andWhere($alias . '.' . $this->field . ' >= :start')
            ->andWhere($alias . '.' . $this->field . ' <= :end')
            ->setParameter(':start', $this->format($start))
            ->setParameter(':end', $this->format($end));
    }

    /**
     * @return string
     */
    private function format($date) : string
    {
        $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

        return $datetime->format('Y-m-d H:i:s');
    }
}
