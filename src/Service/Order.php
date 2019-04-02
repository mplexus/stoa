<?php

namespace Stoa\Service;

use Stoa\Query\DateBuilder;
use Stoa\Query\OrderStatsBuilder;
use Stoa\Query\CustomerStatsBuilder;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\EntityManager;
use Stoa\Model\Order as OrderModel;

class Order extends Base
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function getStats(array $criteria = [])
    {
        $searchEngine = $this->getSearchEngine();
        $searchEngine->add(new OrderStatsBuilder())
            ->add(new DateBuilder('purchaseDate'))
            ;

        $query = $searchEngine->match($criteria);

        return $query->getScalarResult();
    }

    public function getCustomerStats(array $criteria = [])
    {
        $searchEngine = $this->getSearchEngine();
        $searchEngine->add(new CustomerStatsBuilder())
            ->add(new DateBuilder('purchaseDate'))
            ;

        $query = $searchEngine->match($criteria);

        return $query->getScalarResult();
    }

    public function getRevenue($orderId = null)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->getRepository($this->getResource())->createQueryBuilder('o');

        $queryBuilder->select('SUM(i.price) as revenue')
            ->leftJoin('o.orderItems', 'i', Expr\Join::WITH)
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

    public function getTotalRevenue()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->getRepository('Stoa\Model\OrderItem')->createQueryBuilder('i');

        return $queryBuilder->select('SUM(i.price) as revenue')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function getResource()
    {
        return OrderModel::class;
    }

    public function addListBuilders()
    {
        $this->searchEngine->add(new DateBuilder('purchaseDate'));
    }
}
