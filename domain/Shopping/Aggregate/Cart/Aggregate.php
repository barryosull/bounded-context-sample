<?php

namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Aggregate;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\ValueObject\Quantity;
use Domain\Shopping\Entity\Item;

class Cart extends Aggregate
{
	public function create(Identifier $id, Identifier $customer_id) 
	{
		$this->assert->not(Invariant\CheckedOut::class);

		$this->apply( new Cart\Created($id, $customer_id) );
        $this->apply( new Cart\IsEmpty($id) );
	}

	public function add_item(Item $item) 
	{
		$this->assert->is(Invariant\CheckedOut::class);
		$this->assert->not(Invariant\HasItem::class);
        $this->assert->not(Invariant\Full::class);
        
        $this->apply( new Cart\ItemAdded($this->state->id(), $item) );
        
        if ($this->check->is(Invariant\Full::class)) {
            $this->apply( new Cart\Full($this->state->id()) );
        }
	}

	public function remove_item(Identifier $id) 
	{
		$this->assert->not(Invariant\CheckedOut::class);
		$this->assert->is(Invariant\HasItem::class);

		$this->apply( new Cart\ItemRemoved($this->state->id(), $this->state->item($id)));
        
        if ($this->check->is(Invariant\IsEmpty::class)) {
            $this->apply( new Cart\IsEmpty($this->state->id()) );
        }
	}

	public function change_item_quantity(Identifier $id, Quantity $quantity) 
	{
		$this->assert->not(Invariant\CheckedOut::class);
		$this->assert->is(Invariant\HasItem::class, $id);
        
        $old_item = $this->state->item($id);
        $item = $old_item->change_quantity($quantity);
        
		$this->apply( new Cart\ItemQuantityChanged($this->state->id(), $item) );
	}

	public function checkout() 
    {
		$this->assert->not(Invariant\CheckedOut::class);

		$this->apply( new Cart\CheckedOut($this->state->id()) );
	}
}