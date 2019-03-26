<?php
/**
* Lists all orders
*/

require_once __DIR__.'/../src/bootstrap.php';

/**
 * @var $orders \Stoa\Model\Order[] Retrieve the list of all orders
 */
$orders = $entityManager->getRepository('Stoa\Model\Order')->findAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>List of Orders</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
  </head>
  <body>
    <div class="container m-5">
      <h3>List of Orders</h3>
      <div class="card">
        <?php if (!empty($orders)) : ?>
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Purchased At</th>
              <th>Customer</th>
              <th>Country</th>
              <th>Items</th>
            </tr>
          </thead>
            <?php foreach ($orders as $order) : ?>
          <tr>
            <td>
                <a href="items.php?id=<?=$order->getId()?>">
                    <?=htmlspecialchars($order->getId())?>
                </a>
            </td>
            <td><?=$order->getPurchaseDate()->format('Y-m-d H:i:s')?></td>
            <td><?=nl2br(htmlspecialchars($order->getCustomer()->getFullName()))?></td>
            <td><?=nl2br(htmlspecialchars($order->getCountry()))?></td>
            <td><?=nl2br(htmlspecialchars(count($order->getOrderItems())))?></td>
          </tr>
            <?php endforeach; ?>
        </table>
        <?php else : ?>
          <p>No orders, for now!</p>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>
