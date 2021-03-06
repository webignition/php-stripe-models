<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\AbstractObject;

class Plan extends AbstractObject
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getDataProperty('name');
    }

    /**
     * @return int
     */
    public function getTrialPeriodDays()
    {
        return $this->getDataProperty('trial_period_days');
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
    public function getInterval()
    {
        return $this->getDataProperty('interval');
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->getDataProperty('currency');
    }
}
