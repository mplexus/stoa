<?php

namespace Stoa\Model;

use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="orders", indexes={
 *  @Index(name="publication_date_idx", columns="purchase_date")
 * })
 **/
class Order
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @var \DateTime
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
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
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get device.
     *
     * @return string
     */
    public function getDevice()
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
    public function setDevice($device)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get purchaseDate.
     *
     * @return \DateTime
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * Set purchaseDate.
     *
     * @param \DateTime $purchaseDate
     *
     * @return Order
     */
    public function setPurchaseDate($date)
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
    public function addOrderItem(OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItem.
     *
     * @param OrderItem $orderItem
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrderItem(OrderItem $orderItem)
    {
        return $this->orderItems->removeElement($orderItem);
    }

    /**
     * Get orderItems.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }
}
