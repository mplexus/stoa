<?php

declare(strict_types = 1);

namespace Stoa\Controller;

use Stoa\Core\Application;
use Stoa\Service\Order as OrderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    private $orderService;

    public function __construct(Application $app) {
        parent::__construct($app);
    }

    protected function getService(){
        if ($this->orderService == null) {
            $this->orderService = new OrderService($this->app->getEntityManager());
        }

        return $this->orderService;
    }

    public function listAction(Request $request)
    {
        $orderService = $this->getService();

        $queryData = $request->query;

        $this->totals  = $orderService->getTotals();

        return new Response($this->totals);
    }
}
