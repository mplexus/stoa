<?php

declare(strict_types = 1);

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
     * @Column(type="integer", options={"unsigned"=true})
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
     * @Column(type="integer", options={"unsigned"=true})
     */
    protected $quantity;

    /**
     * @var int
     *
     * @Column(type="integer", options={"unsigned"=true})
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
    public function getId() : int
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
    public function setEan($ean) : OrderItem
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get ean.
     *
     * @return int
     */
    public function getEan() : int
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
    public function setQuantity($quantity) : OrderItem
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity() : int
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
    public function setPrice($price) : OrderItem
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return int
     */
    public function getPrice() : int
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
    public function setOrder(Order $order = null) : OrderItem
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order.
     *
     * @return Order|null
     */
    public function getOrder() : ?Order
    {
        return $this->order;
    }
}
