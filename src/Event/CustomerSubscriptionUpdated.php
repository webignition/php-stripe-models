<?php

namespace webignition\Model\Stripe\Event;

use webignition\Model\Stripe\Subscription;

class CustomerSubscriptionUpdated extends Event
{
    /**
     * @return bool
     */
    public function isPlanChange()
    {
        $dataObject = $this->getDataObject();

        if (!$dataObject->hasPreviousAttributes()) {
            return false;
        }

        return $dataObject->getPreviousAttributes()->containsKey('plan');
    }

    /**
     * @return bool
     */
    public function isStatusChange()
    {
        $dataObject = $this->getDataObject();

        if (!$dataObject->hasPreviousAttributes()) {
            return false;
        }

        return $dataObject->getPreviousAttributes()->containsKey('status');
    }

    /**
     * @return string|null
     */
    public function getStatusChange()
    {
        if (!$this->isStatusChange()) {
            return null;
        }

        $dataObject = $this->getDataObject();

        /* @var Subscription $subscription */
        $subscription = $dataObject->getObject();

        return $dataObject->getPreviousAttributes()->get('status') . ':' . $subscription->getStatus();
    }

    /**
     * @param string $statusChange
     *
     * @return bool
     */
    public function hasStatusChange($statusChange)
    {
        return $this->getStatusChange() == $statusChange;
    }
}
