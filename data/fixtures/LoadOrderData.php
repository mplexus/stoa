<?php

use Stoa\Model\Order;
use Stoa\Model\Customer;
use Stoa\Model\OrderItem;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
* Post fixtures
*/
class LoadData implements FixtureInterface
{

    private $countries = ['Italy', 'Nicaragua', 'Nauru', 'Tahiti'];

    const NUMBER_OF_ORDERS = 10;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $customers = [];
        for ($i = 0; $i <= 3; $i++) {
            $customer = new Customer();
            $customer->setFirstName($this->generateRandomString(5, false))
                ->setLastName($this->generateRandomString(5, false))
                ->setEmail($customer->getFirstName() . '.' . $customer->getLastName(). "@mail.com")
                ;
            $manager->persist($customer);
            $customers[$i] = $customer;
        }

        $orders = [];
        for ($i = 0; $i < self::NUMBER_OF_ORDERS; $i++) {
            $order = new Order();
            $order->setCountry($this->countries[rand(0,3)])
                ->setDevice($this->generateRandomString())
                ->setPurchaseDate($this->generateRandomDate())
                ->setCustomer($customers[rand(0,2)])
                ;
            $manager->persist($order);
            $orders[$i] = $order;
        }

        $items = [];
        for ($i = 0; $i <= (self::NUMBER_OF_ORDERS * 2) ; $i++) {
            $item = new OrderItem();
            $item->setEan($this->generateRandomString(5, true))
                ->setQuantity($this->generateRandomString(1, true))
                ->setPrice($this->generateRandomString(3, true))
                ->setOrder($orders[rand(0, self::NUMBER_OF_ORDERS-1)])
                ;
            $manager->persist($item);
            $items[$i] = $item;
        }

        $manager->flush();
    }

    protected function generateRandomString($length = 10, $numeric = true) {
        $characters = $numeric ? '123456789' : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function generateRandomDate()
    {
        $min = strtotime("-1 month");
        $max = strtotime("+1 month");
        echo $min." - ".$max;
        $val = rand($min, $max);
        echo "-->".$val."\n";
        $date = date("Y-m-d H:i:s", $val);
        echo $date."\n";
        return new \DateTime($date);
    }
}
