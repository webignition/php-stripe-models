<?php

namespace webignition\Model\Stripe\Event;

use Doctrine\Common\Collections\ArrayCollection;
use webignition\Model\Stripe\Object\Factory as ObjectFactory;
use webignition\Model\Stripe\Object\AbstractObject;

class Data extends AbstractObject
{
    /**
     * {@inheritdoc}
     */
    public function __construct($json)
    {
        parent::__construct($json);

        $this->setDataProperty('object', ObjectFactory::create(json_encode($this->getDataProperty('object'))));

        if ($this->hasPreviousAttributes()) {
            $previousAttributesCollection = new ArrayCollection();

            foreach ($this->getPreviousAttributes() as $key => $value) {
                $valueIsObject = $value instanceof \stdClass;
                $valueHasObject = isset($value->object);

                if ($valueIsObject && $valueHasObject && ObjectFactory::isKnownEntityType($value->object)) {
                    $value = ObjectFactory::create(json_encode($value));
                }

                $previousAttributesCollection->set($key, $value);
            }

            $this->setDataProperty('previous_attributes', $previousAttributesCollection);
        }
    }

    /**
     * @return AbstractObject
     */
    public function getObject()
    {
        return $this->getDataProperty('object');
    }

    /**
     * @return ArrayCollection|null
     */
    public function getPreviousAttributes()
    {
        return $this->getDataProperty('previous_attributes');
    }

    /**
     * @return bool
     */
    public function hasPreviousAttributes()
    {
        return $this->hasDataProperty('previous_attributes');
    }
}
