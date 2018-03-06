<?php

namespace webignition\Model\Stripe;

use Doctrine\Common\Collections\ArrayCollection;
use webignition\Model\Stripe\Object\AbstractObject;
use webignition\Model\Stripe\Object\Factory;

class ObjectList extends AbstractObject
{
    /**
     * @var ArrayCollection
     */
    private $items;

    /**
     * {@inheritdoc}
     */
    public function __construct($json)
    {
        parent::__construct($json);

        $this->items = new ArrayCollection();

        if ($this->hasDataProperty('data')) {
            foreach ($this->getDataProperty('data') as $item) {
                $this->items->add(Factory::create(json_encode($item)));
            }
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->getDataProperty('url');
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        $returnArray = parent::__toArray();

        if (isset($returnArray['data'])) {
            foreach ($returnArray['data'] as $index => $item) {
                $returnArray['data'][$index] = Factory::create(json_encode($item))->__toArray();
            }
        }

        return $returnArray;
    }
}
