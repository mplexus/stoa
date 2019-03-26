<?php

namespace Stoa\Controller;

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

    abstract protected function getService();

    /**
     * Return the paginator params for the list action.
     *
     * @return array
     */
    protected function getPaginatorParams() {
        $params = array();
        $range  = $this->getParam('range', static::PAGE_RANGE);
        $count  = $this->getParam('count', static::ITEM_COUNT_PER_PAGE);

        $params['pageRange']         = $range;
        $params['currentPageNumber'] = $this->getParam('page', 1);
        $params['itemCountPerPage']  = $count;

        return $params;
    }
}
