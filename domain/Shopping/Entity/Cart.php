<?php 

namespace Domain\Shopping\Aggregate\Cart\Entity;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Entity\AbstractEntity;

class Cart extends AbstractEntity
{
    protected $customer_id;
    
    public function __construct(Identifier $id, Identifier $customer_id)
    {
        parent::__construct($id);
        $this->customer_id = $customer_id;
    }
    
    public function customer_id()
    {
        return $this->customer_id;
    }
}