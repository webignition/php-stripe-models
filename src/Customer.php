<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\AbstractObject;

class Customer extends AbstractObject
{
    /**
     * @var ObjectList
     */
    private $subscriptions;

    /**
     * @var ObjectList
     */
    private $cards;

    /**
     * {@inheritdoc}
     */
    public function __construct($json)
    {
        parent::__construct($json);

        if ($this->hasDataProperty('subscription')) {
            $this->setDataProperty(
                'subscription',
                new Subscription(json_encode($this->getDataProperty('subscription')))
            );
        }

        if ($this->hasDataProperty('discount')) {
            $this->setDataProperty('discount', new Discount(json_encode($this->getDataProperty('discount'))));
        }

        $this->subscriptions = new ObjectList(json_encode($this->getDataProperty('subscriptions')));

        if ($this->hasDataProperty('active_card')) {
            $this->setDataProperty('active_card', new Card(json_encode($this->getDataProperty('active_card'))));
        }

        $this->cards = new ObjectList(json_encode($this->getDataProperty('cards')));
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getDataProperty('id');
    }

    /**
     * @return bool
     */
    public function hasCard()
    {
        return !is_null($this->getDataProperty('active_card'));
    }

    /**
     * @return Subscription
     */
    public function getSubscription()
    {
        return $this->getDataProperty('subscription');
    }

    /**
     * @return bool
     */
    public function hasSubscription()
    {
        return !is_null($this->getSubscription());
    }

    /**
     * @return ObjectList
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * @return Card
     */
    public function getActiveCard()
    {
        return $this->getDataProperty('active_card');
    }

    /**
     * @return bool
     */
    public function hasActiveCard()
    {
        return !is_null($this->getActiveCard());
    }

    /**
     * @return ObjectList
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     *
     * @return array
     */
    public function __toArray()
    {
        $returnArray = parent::__toArray();

        $returnArray['subscriptions'] = $this->getSubscriptions()->__toArray();
        $returnArray['cards'] = $this->getCards()->__toArray();

        return $returnArray;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->getDataProperty('discount');
    }

    /**
     * @return bool
     */
    public function hasDiscount()
    {
        return !is_null($this->getDiscount());
    }
}
