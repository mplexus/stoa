<?php

declare(strict_types = 1);

namespace Stoa\Service;

use Stoa\Query\DateBuilder;
use Stoa\Query\Transformer;
use Stoa\Query\OrderStatsBuilder;
use Stoa\Query\OrderTransformer;
use Stoa\Query\CustomerStatsBuilder;
use Doctrine\ORM\EntityManager;
use Stoa\Model\Order as OrderModel;

class Order extends Base
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function getStats(array $criteria = []) : array
    {
        $searchEngine = $this->getSearchEngine();
        $searchEngine->add(new OrderStatsBuilder())
            ->add(new DateBuilder('purchaseDate'))
            ;

        $query = $searchEngine->match($criteria);

        return $query->getScalarResult();
    }

    public function getCustomerStats(array $criteria = []) : array
    {
        $searchEngine = $this->getSearchEngine();
        $searchEngine->add(new CustomerStatsBuilder())
            ->add(new DateBuilder('purchaseDate'))
            ;

        $query = $searchEngine->match($criteria);

        return $query->getResult();
    }

    public function getCustomerStatsByDay(array $criteria = []) : array
    {
        $searchEngine = $this->getSearchEngine();
        $searchEngine->add(new CustomerStatsBuilder())
            ->add(new DateBuilder('purchaseDate'))
            ;

        $query = $searchEngine->match($criteria);

        return $this->getTransformer()->transform($query->getResult());
    }

    /**
     * Query the total revenue of every or a specific one order
     * and return it as a string.
     *
     * @param int|null $orderId
     * @return string|null
     */
    public function getRevenue($orderId = null) : ?string
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->getRepository($this->getResource())->createQueryBuilder('o');

        $queryBuilder->select('SUM(i.price * i.quantity) as revenue')
            ->leftJoin('o.orderItems', 'i')
            ;

        if ($orderId) {
            $queryBuilder->where('o.id = :order_id')
            ->setParameter('order_id', $orderId)
            ;
        }

        return $queryBuilder->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @return string
     */
    public function getResource() : string
    {
        return OrderModel::class;
    }

    /**
     * @inheritdoc.
     */
    public function addListBuilders() : void
    {
        $this->searchEngine->add(new DateBuilder('purchaseDate'));
    }

    /**
     * @inheritdoc.
     */
    public function getTransformer() : Transformer
    {
        return new OrderTransformer();
    }
}
