<?php

declare(strict_types = 1);

namespace Stoa\Model;

use DateTime;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 * @Table(name="orders", indexes={
 *  @Index(name="purchase_date_idx", columns="purchase_date")
 * })
 **/
class Order
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer", options={"unsigned"=true})
     */
    protected $id;

    /**
     * @var DateTime
     *
     * @Column(type="datetime", name="purchase_date")
     */
    protected $purchaseDate;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $country;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $device;

    /**
    * @var OrderItem[]
    *
    * @OneToMany(targetEntity="OrderItem", mappedBy="order")
    */
    protected $orderItems;

    /**
    * @var Customer
    *
    * @ManyToOne(targetEntity="Customer", inversedBy="orders")
    */
    protected $customer;

    /**
    * Initializes collections
    */
    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

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
     * Get country.
     *
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * Set country.
     *
     * @param string $country
     *
     * @return Order
     */
    public function setCountry($country) : Order
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get device.
     *
     * @return string
     */
    public function getDevice() : string
    {
        return $this->device;
    }

    /**
     * Set device.
     *
     * @param string $device
     *
     * @return Order
     */
    public function setDevice($device) : Order
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get purchaseDate.
     *
     * @return DateTime
     */
    public function getPurchaseDate() : DateTime
    {
        return $this->purchaseDate;
    }

    /**
     * Set purchaseDate.
     *
     * @param DateTime $purchaseDate
     *
     * @return Order
     */
    public function setPurchaseDate($date) : Order
    {
        $this->purchaseDate = $date;

        return $this;
    }

    /**
     * Add orderItem.
     *
     * @param OrderItem $orderItem
     *
     * @return Order
     */
    public function addOrderItem(OrderItem $orderItem) : Order
    {
        $this->orderItems[] = $orderItem;
        $orderItem->setOrder($this);

        return $this;
    }

    /**
     * Remove orderItem.
     *
     * @param OrderItem $orderItem
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrderItem(OrderItem $orderItem) : boolean
    {
        return $this->orderItems->removeElement($orderItem);
    }

    /**
     * Get orderItems.
     *
     * @return Collection
     */
    public function getOrderItems() : Collection
    {
        return $this->orderItems;
    }

    /**
     * Set customer.
     *
     * @param Customer|null $customer
     *
     * @return Order
     */
    public function setCustomer(Customer $customer = null) : Order
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer.
     *
     * @return Customer|null
     */
    public function getCustomer() : Customer
    {
        return $this->customer;
    }
}
