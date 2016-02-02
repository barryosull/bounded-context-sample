<?php

namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\Entity\Item;

class AddItem extends Command
{
    public $item;
    
    public function __construct(Identifier $id, Item $item)
    {
        $this->item = $item;
        parent::__construct($id);
    }
}
