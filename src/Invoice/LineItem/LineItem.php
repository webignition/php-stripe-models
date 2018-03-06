<?php

namespace webignition\Model\Stripe\Invoice\LineItem;

use webignition\Model\Stripe\Object\AbstractObject;
use webignition\Model\Stripe\Period;

abstract class LineItem extends AbstractObject
{
    /**
     * @return string
     */
    public function getId()
    {
        return $this->getDataProperty('id');
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->getDataProperty('amount');
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->getDataProperty('currency');
    }

    /**
     * @return Period
     */
    public function getPeriod()
    {
        return $this->getDataProperty('period');
    }

    /**
     * @return bool
     */
    public function getIsProrated()
    {
        return $this->getDataProperty('proration');
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->getDataProperty('type');
    }

    /**
     * @return \stdClass
     */
    public function getMetadata()
    {
        return $this->getDataProperty('metadata');
    }
}
