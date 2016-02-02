<?php

namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

class RemoveItem extends Command
{
    public $item_id;
    
    public function __construct(Identifier $id, Identifier $item_id)
    {
        $this->item_id = $item_id;
        parent::__construct($id);
    }
}
