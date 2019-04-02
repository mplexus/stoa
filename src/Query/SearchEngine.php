<?php

namespace Stoa\Query;

use Stoa\Query\Builder;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class SearchEngine
{
    /**
     * @var array
     */
    private $builders = [];

    private $debug = false;

    /**
     * @var EntityRepository
     */
    private $repository;

    private $entityManager;

    /**
     * @param EntityManager $entityManager
     * @param EntityRepository $repository
     */
    public function __construct(EntityManager $entityManager, EntityRepository $repository = null)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->debug = getenv('app_debug');
    }

    /**
     * Adds a builder to search engine to build.
     *
     * @param Builder $builder
     * @return void
     */
    public function add(Builder $builder)
    {
        $this->builders[] = $builder;

        return $this;
    }

    /**
     * {@inheritdoc}
     * @return Query
     */
    public function match(array $criteria)
    {
        $queryBuilder = $this->repository
            ? $this->repository->createQueryBuilder('s')
            : $this->entityManager->createQueryBuilder()
            ;

        foreach ($this->builders as $builder) {
            if (true === $builder->supports($criteria)) {
                $builder->build($criteria, $queryBuilder);
            }
        }

        if ($this->debug) {
            print_r("<br/>".$queryBuilder->getQuery()->getDql());
            foreach ($queryBuilder->getQuery()->getParameters() as $key=>$obj) {
                print_r("<br/>".$obj->getName()."=".$obj->getValue());
            }
        }

        return $queryBuilder->getQuery();
    }
}
