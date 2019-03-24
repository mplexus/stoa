<?php

use strict;

namespace Stoa\Controller;

use Stoa\Service\Index as IndexService;

class IndexController extends AbstractController
{
    private $service;

    protected function getService(){
        if ($this->service == null) {
            $this->service = new IndexService();
        }

        return $this->service;
    }

    public function listAction()
    {
        $service = $this->getService();

        $queryData = $this->getRequest()->getQuery();

        $this->view->filters    = $filters;
        $this->view->filterForm = $form;
        $this->view->totals     = $service->getTotals();
        $this->view->companies  = $service->listCompanies(
            $this->getPaginatorParams(),
            $filters
        );
    }
}
