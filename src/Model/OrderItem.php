<?php

namespace Stoa\Model;

/**
 * @Entity @Table(name="order_items")
 **/
class OrderItem
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     *
     * @Column(type="integer")
     */
    protected $ean;

    /**
     * @var int
     *
     * @Column(type="integer")
     */
    protected $quantity;

    /**
     * @var int
     *
     * @Column(type="integer")
     */
    protected $price;

    /**
    * @var Order
    *
    * @ManyToOne(targetEntity="Order", inversedBy="orderItems")
    */
    protected $order;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ean.
     *
     * @param int $ean
     *
     * @return OrderItem
     */
    public function setEan($ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get ean.
     *
     * @return int
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return OrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price.
     *
     * @param int $price
     *
     * @return OrderItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set order.
     *
     * @param Order|null $order
     *
     * @return OrderItem
     */
    public function setOrder(Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order.
     *
     * @return Order|null
     */
    public function getOrder()
    {
        return $this->order;
    }
}
