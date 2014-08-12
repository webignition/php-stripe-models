<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\Object;

class Coupon extends Object {

    /**
     * @return string
     */
    public function getId() {
        return $this->getDataProperty('id');
    }


    /**
     * @return int
     */
    public function getPercentOff() {
        return (int)$this->getDataProperty('percent_off');
    }

}