<?php

use \Doctrine\Common\Collections\ArrayCollection;

namespace Stoa\Model;

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
     * @param \Stoa\Model\Order $order
     *
     * @return Customer
     */
    public function addOrder(\Stoa\Model\Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order.
     *
     * @param \Stoa\Model\Order $order
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrder(\Stoa\Model\Order $order)
    {
        return $this->orders->removeElement($order);
    }

    /**
     * Get orders.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
