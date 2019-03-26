<?php

namespace Stoa\Controller;

use Stoa\Core\Application;
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

    protected $app;

    abstract protected function getService();

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Return the paginator params for the list action.
     *
     * @return array
     */
    protected function getPaginatorParams()
    {
        $params = array();
        $range  = $this->getParam('range', static::PAGE_RANGE);
        $count  = $this->getParam('count', static::ITEM_COUNT_PER_PAGE);

        $params['pageRange']         = $range;
        $params['currentPageNumber'] = $this->getParam('page', 1);
        $params['itemCountPerPage']  = $count;

        return $params;
    }

    protected function render($template, array $params = [], int $status = 200)
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
                        'icon' => 'tags',
                    ],
                    'Orders' => [
                        'url' => '/orders',
                        'label' => 'Orders',
                        'active' => $requestUri === '/orders',
                        'icon' => 'list-alt',
                    ]
                ]
            ],
            [
                'env' => $this->app->env
            ],
            [
                'name' => $this->app->name,
                'title' => $this->app->name . '::' . $this->title,
            ],
            $params
        );
        $content = $this->app->twig->render($template, $params);

        return new Response($content, $status);
    }
}
