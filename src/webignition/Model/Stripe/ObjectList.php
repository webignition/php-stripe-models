<?php

namespace webignition\Model\Stripe;

use Doctrine\Common\Collections\ArrayCollection;
use webignition\Model\Stripe\Object\Object;
use webignition\Model\Stripe\Object\Factory;

class ObjectList extends Object {
    
    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection 
     */
    private $items;
    
    public function __construct($json) {
        parent::__construct($json);
        
        $this->items = new ArrayCollection();
        
        if ($this->hasDataProperty('data')) {
            foreach ($this->getDataProperty('data') as $item) {
                $this->items->add(Factory::create(json_encode($item)));
            }            
        }
    }
    
    
    /**
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItems() {
        return $this->items;
    }
    
    
    /**
     * 
     * @return string
     */
    public function getUrl() {
        return $this->getDataProperty('url');
    }
    
    /**
     * 
     * @return array
     */
    public function __toArray() {
        //$returnArray = (array)$this->getData();
        $returnArray = parent::__toArray();
        
        foreach ($returnArray['data'] as $index => $item) {
            $returnArray['data'][$index] = Factory::create(json_encode($item))->__toArray();
        }
        
        return $returnArray;
    }
    
}