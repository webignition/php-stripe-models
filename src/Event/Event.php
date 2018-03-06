<?php

namespace webignition\Model\Stripe\Event;

use webignition\Model\Stripe\Object\AbstractObject;

class Event extends AbstractObject
{
    /**
     * {@inheritdoc}
     */
    public function __construct($json)
    {
        parent::__construct($json);

        $this->setDataProperty('data', new Data(json_encode($this->getDataProperty('data'))));
    }

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
    public function getCreated()
    {
        return (int)$this->getDataProperty('created');
    }

    /**
     * @return Data
     */
    public function getDataObject()
    {
        return $this->getDataProperty('data');
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->getDataProperty('type');
    }

    /**
     * @return int
     */
    public function getPendingWebhooks()
    {
        return (int)$this->getDataProperty('pending_webhooks');
    }

    /**
     * @return string|null
     */
    public function getRequestId()
    {
        return $this->getDataProperty('request');
    }

    /**
     * @return bool
     */
    public function hasRequestId()
    {
        return !is_null($this->getRequestId());
    }
}
