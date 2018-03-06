<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\AbstractObject;

class Subscription extends AbstractObject
{
    /**
     * @var Period
     */
    private $currentPeriod;

    /**
     * @var Period
     */
    private $trialPeriod;

    /**
     * {@inheritdoc}
     */
    public function __construct($json)
    {
        parent::__construct($json);

        if ($this->hasDataProperty('plan')) {
            $this->setDataProperty('plan', new Plan(json_encode($this->getDataProperty('plan'))));
        }

        if ($this->hasDataProperty('trial_start')) {
            $this->trialPeriod = new Period(json_encode(array(
                'start' => $this->getDataProperty('trial_start'),
                'end' => $this->getDataProperty('trial_end'),
            )));
        }

        $this->currentPeriod = new Period(json_encode(array(
            'start' => $this->getDataProperty('current_period_start'),
            'end' => $this->getDataProperty('current_period_end'),
        )));
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getDataProperty('id');
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
    public function getStart()
    {
        return (int)$this->getDataProperty('start');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getDataProperty('status');
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->getStatus() == 'active';
    }

    /**
     * @return bool
     */
    public function isTrialing()
    {
        return $this->getStatus() == 'trialing';
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return $this->getStatus() == 'canceled';
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getDataProperty('customer');
    }

    /**
     * @return bool
     */
    public function getCancelAtPeriodEnd()
    {
        return $this->getDataProperty('cancel_at_period_end');
    }

    /**
     * @return int|null
     */
    public function getEndedAt()
    {
        $endedAt = $this->getDataProperty('ended_at');
        return (is_null($endedAt)) ? null : (int)$endedAt;
    }

    /**
     * @return Period
     */
    public function getTrialPeriod()
    {
        return $this->trialPeriod;
    }

    /**
     * @return bool
     */
    public function hasTrialPeriod()
    {
        return !is_null($this->getTrialPeriod());
    }

    /**
     * @return int|null
     */
    public function getCancelledAt()
    {
        return $this->getDataProperty('canceled_at');
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return (int)$this->getDataProperty('quantity');
    }

    /**
     * @return int
     */
    public function getApplicationFeePercent()
    {
        return (int)$this->getDataProperty('application_fee_percent');
    }

    /**
     * @return null
     */
    public function getDiscount()
    {
        // Not yet implemented
        return null;
    }

    /**
     * @return bool
     */
    public function wasCancelledDuringTrial()
    {
        if (!$this->isCancelled()) {
            return false;
        }

        if (!$this->hasTrialPeriod()) {
            return false;
        }

        return $this->getCancelledAt() <= $this->getTrialPeriod()->getEnd();
    }

    /**
     *
     * @return Period
     */
    public function getCurrentPeriod()
    {
        return $this->currentPeriod;
    }
}
