<?php

namespace Stoa\Service;

class Order extends Base
{
    public function getTotals() {
        $entityManager = $this->getEntityManager();
        $orders = $entityManager->getRepository('Stoa\Model\Order')->findAll();

        return count($orders);
    }
}
