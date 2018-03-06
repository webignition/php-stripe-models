<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\AbstractObject;

class Discount extends AbstractObject
{
    /**
     * @var Period
     */
    private $period;

    /**
     * {@inheritdoc}
     */
    public function __construct($json)
    {
        parent::__construct($json);
        if ($this->hasDataProperty('coupon')) {
            $this->setDataProperty('coupon', new Coupon(json_encode($this->getDataProperty('coupon'))));
        }

        $this->period = new Period(json_encode(array(
            'start' => $this->getDataProperty('start'),
            'end' => $this->getDataProperty('end'),
        )));
    }

    /**
     * @return Period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getDataProperty('customer');
    }

    /**
     * @return Coupon
     */
    public function getCoupon()
    {
        return $this->getDataProperty('coupon');
    }
}
