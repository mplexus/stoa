<?php

declare(strict_types = 1);

namespace Stoa\Controller;

use Stoa\Service\Order as OrderService;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    private $orderService;

    public function __construct() {
        
    }

    protected function getService(){
        if ($this->orderService == null) {
            $this->orderService = new OrderService();
        }

        return $this->orderService;
    }

    public function listAction(Request $request)
    {
        $orderService = $this->getService();

        $queryData = $request->query;

        $this->totals  = $orderService->getTotals();
        //$this->view->orders  = $service->listCompanies(
        //    $this->getPaginatorParams(),
            //$queryData
        //);
    }
}
