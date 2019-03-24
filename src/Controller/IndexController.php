<?php

declare(strict_types = 1);

namespace Stoa\Controller;

use Stoa\Service\Index as IndexService;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    private $service;

    protected function getService(){
        if ($this->service == null) {
            $this->service = new IndexService();
        }

        return $this->service;
    }

    public function listAction(Request $request)
    {
        $service = $this->getService();

        $queryData = $request->query;

        $this->view->totals     = $service->getTotals();
        $this->view->companies  = $service->listCompanies(
            $this->getPaginatorParams(),
            $filters
        );
    }
}
