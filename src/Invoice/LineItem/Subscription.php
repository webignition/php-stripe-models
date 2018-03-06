<?php

namespace webignition\Model\Stripe\Invoice\LineItem;

use webignition\Model\Stripe\Plan;
use webignition\Model\Stripe\Period;

class Subscription extends LineItem
{
    /**
     * {@inheritdoc}
     */
    public function __construct($json)
    {
        parent::__construct($json);

        if ($this->hasDataProperty('plan')) {
            $this->setDataProperty('plan', new Plan(json_encode($this->getDataProperty('plan'))));
        }

        if ($this->hasDataProperty('period')) {
            $this->setDataProperty('period', new Period(json_encode($this->getDataProperty('period'))));
        }
    }

    /**
     * @return Plan
     */
    public function getPlan()
    {
        return $this->getDataProperty('plan');
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->getDataProperty('quantity');
    }
}
