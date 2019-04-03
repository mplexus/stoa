<?php

declare(strict_types = 1);

namespace Stoa\Controller;

use Stoa\Core\Application;
use Stoa\Service\Customer as CustomerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends AbstractController
{
    /**
     * @var CustomerService
     */
    private $customerService;

    public function __construct(Application $app)
    {
        $this->title = 'Customers';
        parent::__construct($app);
    }

    protected function getService() : CustomerService
    {
        if ($this->customerService == null) {
            $this->customerService = new CustomerService($this->app->entityManager);
        }

        return $this->customerService;
    }

    public function listAction(Request $request) : Response
    {
        $service = $this->getService();
        $params = array();

        $params['request_uri'] = $request->getRequestUri();

        $params['customers'] = $service->getList();

        return $this->render('customers', $params);
    }

}
