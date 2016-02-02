<?php 

namespace Domain\Shopping\Aggregate\Cart\Entity;

use BoundedContext\Entity\AbstractEntity;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\ValueObject;

class Item extends AbstractEntity
{
    protected $quantity;
    
    public function __construct(Identifier $id,  ValueObject\Quantity $quantity)
    {
        parent::__construct($id);
        $this->quantity = $quantity;
    }
    
    public function quantity()
    {
        return $this->quantity;
    }
    
    public function change_quantity( ValueObject\Quantity $quantity) 
    {
        return new Item($this->id, $quantity);
    }
}