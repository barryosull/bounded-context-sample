<?php

namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

class Create extends Command
{
    public $customer_id;
    
    public function __construct(Identifier $id, Identifier $customer_id)
    {
        $this->customer_id = $customer_id;
        parent::__construct($id);
    }
}
