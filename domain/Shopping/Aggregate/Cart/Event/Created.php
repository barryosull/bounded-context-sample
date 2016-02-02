<?php

namespace Domain\Shopping\Aggregate\Cart\Event;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Event\AbstractEvent;
use Domain\Shopping\Entity\Cart;

class Created extends AbstractEvent
{
    public $cart;
    
    public function __construct(Identifier $id, Cart $cart)
    {
        parent::__construct($id);
        $this->cart = $cart;
    }
}
