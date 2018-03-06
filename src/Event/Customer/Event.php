<?php

namespace webignition\Model\Stripe\Event\Customer;

use webignition\Model\Stripe\Event\Event as BaseEvent;
use webignition\Model\Stripe\Customer;

abstract class Event extends BaseEvent
{
    /**
     * @return Customer
     */
    public function getCustomer()
    {
        /* @var Customer $customer */
        $customer = $this->getDataObject()->getObject();

        return $customer;
    }
}
