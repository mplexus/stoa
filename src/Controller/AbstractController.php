<?php

declare(strict_types = 1);

namespace Stoa\Controller;

use Stoa\Core\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    /**
     * Default number of local pages (i.e., the number of discretes
     * page numbers that will be displayed, including the current
     * page number)
     *
     * @var int
     */
    const PAGE_RANGE          = 10;

    /**
     * Default item count per page.
     * @var int
     */
    const ITEM_COUNT_PER_PAGE = 10;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var string
     */
    protected $titles;

    abstract protected function getService();

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Return the paginator params for the list action.
     *
     * @return array
     */
    protected function getPaginatorParams() : array
    {
        $params = array();
        $range  = $this->getParam('range', static::PAGE_RANGE);
        $count  = $this->getParam('count', static::ITEM_COUNT_PER_PAGE);

        $params['pageRange']         = $range;
        $params['currentPageNumber'] = $this->getParam('page', 1);
        $params['itemCountPerPage']  = $count;

        return $params;
    }

    protected function render($template, array $params = [], int $status = 200) : Response
    {
        $template = $template . '.html.twig';
        $requestUri = $params['request_uri'] ?? '';
        $params = array_merge(
            [
                'menu' => [
                    'Dashboard' => [
                        'url' => '/stats',
                        'label' => 'Dashboard',
                        'active' => $requestUri === '/stats',
                        'icon' => 'chart-bar',
                    ],
                    'Orders' => [
                        'url' => '/orders',
                        'label' => 'Orders',
                        'active' => $requestUri === '/orders',
                        'icon' => 'dolly',
                    ],
                    'Customers' => [
                        'url' => '/customers',
                        'label' => 'Customers',
                        'active' => $requestUri === '/customers',
                        'icon' => 'users',
                    ]
                ]
            ],
            [
                'env' => $this->app->env
            ],
            [
                'name' => $this->app->name,
                'pagetitle' => $this->app->name . '::' . $this->title,
                'title' => $this->title
            ],
            $params
        );
        $content = $this->app->twig->render($template, $params);

        return new Response($content, $status);
    }

    protected function getCriteria(Request $request) : array
    {
        $criteria = [
            'date_from' => date('Y-m-d 00:00:00', strtotime('first day of last month')),
            'date_to' => date('Y-m-d 23:59:59', strtotime('last day of last month')),
        ];

        $criteria = array_merge($criteria, $request->query->all());

        $criteria = array_filter($criteria, 'strlen');

        return $criteria;
    }
}
