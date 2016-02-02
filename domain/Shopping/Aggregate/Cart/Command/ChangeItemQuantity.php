<?php

namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;
use Shopping\ValueObject\Quanitity;

class ChangeItemQuantity extends Command
{
    public $item_id;
    public $quantity;
    
    public function __construct(Identifier $id, Identifier $item_id, Quanitity $quantity)
    {
        $this->item_id = $item_id;
        $this->quantity = $quantity;
        parent::__construct($id);
    }
}
