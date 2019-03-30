<?php

namespace Stoa\Query;

use Stoa\Query\Builder;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class SearchEngine
{
    /**
     * @var array
     */
    private $builders = [];


    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
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
     */
    public function match(array $criteria)
    {
        $queryBuilder = $this->repository->createQueryBuilder('s');

        foreach ($this->builders as $builder) {
            if (true === $builder->supports($criteria)) {
                $builder->build($criteria, $queryBuilder);
            }
        }

        return $queryBuilder->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }
}
