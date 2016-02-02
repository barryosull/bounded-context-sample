<?php

namespace Domain\Shopping\ValueObject;
use BoundedContext\ValueObject;
use BoundedContext\ValueObject\Invariant;

class Quantity extends ValueObject\Single
{
    protected function invariants() {
        return [
          Invariant\IsInteger::class,
          Invariant\IsGreaterThenZero::class
        ] + parent::invariants();
    }
}