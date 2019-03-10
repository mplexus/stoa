<?php

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

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($fname)
    {
        $this->first_name = $fname;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($lname)
    {
        $this->last_name = $lname;
    }
}
