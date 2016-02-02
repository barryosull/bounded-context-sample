<?php

namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

class Checkout extends Command
{
    public function __construct(Identifier $id)
    {
        parent::__construct($id);
    }
}
