<?php

declare(strict_types = 1);

namespace Stoa\Model;

use Stoa\Model\BaseModel as Base;
use \Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\Common\Collections\Collection;

/**
 * @Entity @Table(name="customers")
 **/
class Customer extends Base
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer", options={"unsigned"=true})
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
     * @Column(type="string", length=254)
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
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName() : string
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
    public function setFirstName($fname) : Customer
    {
        $this->first_name = $fname;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName() : string
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
    public function setLastName($lname) : Customer
    {
        $this->last_name = $lname;

        return $this;
    }

    /**
     * Get firstName and lastName.
     *
     * @return string
     */
    public function getFullName() : string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail() : string
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
    public function setEmail($email) : Customer
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
    public function addOrder(Order $order) : Customer
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
    public function removeOrder(Order $order) : Order
    {
        return $this->orders->removeElement($order);
    }

    /**
     * Get orders.
     *
     * @return Collection
     */
    public function getOrders() : Collection
    {
        return $this->orders;
    }
}
