<?php

namespace Stoa\Model;

use \Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\Common\Collections\Collection;

/**
 * @Entity @Table(name="customers")
 **/
class Customer
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $first_name;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $last_name;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $email;

    /**
    * @var Order[]
    *
    * @OneToMany(targetEntity="Order", mappedBy="customer")
    */
    protected $orders;

    /**
    * Initializes collections
    */
    public function __construct()
    {
        $this->orders = new ArrayCollection();
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
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Customer
     */
    public function setFirstName($fname)
    {
        $this->first_name = $fname;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Customer
     */
    public function setLastName($lname)
    {
        $this->last_name = $lname;

        return $this;
    }

    /**
     * Get firstName and lastName.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Add order.
     *
     * @param Order $order
     *
     * @return Customer
     */
    public function addOrder(Order $order)
    {
        $this->orders[] = $order;
        $order->setCustomer($this);

        return $this;
    }

    /**
     * Remove order.
     *
     * @param Order $order
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrder(Order $order)
    {
        return $this->orders->removeElement($order);
    }

    /**
     * Get orders.
     *
     * @return Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
