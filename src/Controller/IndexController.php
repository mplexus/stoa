<?php

declare(strict_types = 1);

namespace Stoa\Controller;

use Stoa\Core\Application;
use Stoa\Service\Order as OrderService;
use Stoa\Service\Customer as CustomerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    private $orderService;

    private $customerService;

    protected $title;

    public function __construct(Application $app)
    {
        $this->title = 'Dashboard';
        parent::__construct($app);
    }

    protected function getService()
    {
        $this->getOrderService;
        $this->getCustomerService;
    }

    protected function getOrderService()
    {
        if ($this->orderService == null) {
            $this->orderService = new OrderService($this->app->entityManager);
        }

        return $this->orderService;
    }

    protected function getCustomerService()
    {
        if ($this->customerService == null) {
            $this->customerService = new CustomerService($this->app->entityManager);
        }

        return $this->customerService;
    }

    public function statsAction(Request $request)
    {
        $orderService = $this->getOrderService();
        $customerService = $this->getCustomerService();
        $params = array();

        $params['request_uri'] = $request->getRequestUri();

        $criteria = $this->getCriteria($request);
        $params['criteria'] = $criteria;

        $stats = $orderService->getStats($criteria);
        $params['total_orders'] = $stats[0]['quantity'];
        $params['total_revenue'] = $stats[0]['revenue'];

        $params['total_customers'] = $customerService->getTotals();

        $params['customer_orders'] = $orderService->getCustomerStats($criteria);
        return $this->render('stats', $params);
    }

    public function indexAction(Request $request)
    {
        return $this->render('index');
    }
}
