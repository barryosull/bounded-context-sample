<?php

namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Projector;

class State extends Projector implements Queryable 
{    
    protected $id;
    protected $items = [];
    protected $is_checked_out = false;
    
    //Commands
    protected function when_created(Event\Created $event) 
    {
        $this->id = $event->id;
    }
    
    protected function when_item_added(Event\ItemAdded $event) 
    {
        $this->items[$event->item->id] = $event->item;
    }
    
    protected function when_item_removed(Event\ItemRemoved $event) 
    {
        unset($this->items[$event->item->id]);
    }
    
    protected function when_item_quantity_changed(Event\ItemQuantityChanged $event) 
    {
        $this->items[$event->item->id] = $event->item;
    }
    
    protected function when_checked_out(Event\CheckedOut $event) 
    {
        $this->is_checked_out = true;
    }
    
    //Queries
    public function item($id) 
    {
        return $this->items[$id];
    }
    
    public function id() 
    {
        return $this->id;
    }
    
    public function has_item($id) 
    {
        return isset($this->items[$id]);
    }
    
    public function number_of_items() {
        return count($this->items);
    }
    
    public function is_checked_out() 
    {
        return $this->is_checked_out;
    }
}
