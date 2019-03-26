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
        $this->title = 'Dashboard';
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

        $orders  = $orderService->findAll();

        $params['orders'] = $orders;

        return $this->render('orders', $params);
    }

}
