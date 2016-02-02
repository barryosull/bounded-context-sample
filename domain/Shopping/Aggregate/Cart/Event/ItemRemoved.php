<?php

namespace Domain\Shopping\Aggregate\Cart\Event;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Event\AbstractEvent;

class ItemRemoved extends AbstractEvent
{
    public $item;
    
    public function __construct(Identifier $id, Item $item)
    {
        parent::__construct($id);
        $this->item = $item;
    }
}
