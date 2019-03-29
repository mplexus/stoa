<?php

declare(strict_types = 1);

namespace Stoa\Controller;

use Stoa\Core\Application;
use Stoa\Service\Order as OrderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractController
{
    private $orderService;

    protected $title;

    public function __construct(Application $app)
    {
        $this->title = 'Orders';
        parent::__construct($app);
    }

    protected function getService()
    {
        if ($this->orderService == null) {
            $this->orderService = new OrderService($this->app->entityManager);
        }

        return $this->orderService;
    }

    public function listAction(Request $request)
    {
        $orderService = $this->getService();
        $params = array();

        $params['request_uri'] = $request->getRequestUri();

        $queryData = $request->query;

        $params['orders'] = $orderService->getList();

        return $this->render('orders', $params);
    }

    public function viewAction(Request $request, $id)
    {
        $orderService = $this->getService();
        $params = array();

        $params['request_uri'] = $request->getRequestUri();

        $params['order'] = $orderService->getItem($id);
        $params['revenue'] = $orderService->getRevenue($id);

        return $this->render('order_details', $params);
    }

}
