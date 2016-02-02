<?php

namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Handler;
use Projection\Queryable;

class Handler extends Handler 
{
    public $repo;
    
    public function __construct(Repository $repo, Queryable $queryable) {
        $this->repo = $repo;
        
        //$queryable is used by the handle invariants
        parent::__construct($queryable);
    }
    
    public function handle_create(Command\Create $cmd, Factory $factory) 
    {
        $this->assert->not(Invariant\UserHasPendingCart::class);
        
        $cart = $factory->make_new();
        $cart->create($cmd->id, $cmd->customer_id);
        
        $this->repo->store($cart);
    }    
    
    public function handle_add_item(Command\AddItem $cmd) 
    {
        $cart = $this->repo->fetch($cmd->id);
        $cart->add_item($cmd->item);
        $this->repo->store($cart);
    }
    
    public function handle_remove_item(Command\RemoveItem $cmd) 
    {
        $cart = $this->repo->fetch($cmd->id);
        $cart->remove_item($cmd->item_id);
        $this->repo->store($cart);
    }
    
    public function handle_change_item_quantity(Command\ChangeItemQuantity $cmd) 
    {
        $cart = $this->repo->fetch($cmd->id);
        $cart->change_item_quantity($cmd->item_id, $cmd->quantity);
        $this->repo->store($cart);
    }
    
    public function handle_checkout(Command\Checkout $cmd) 
    {
        $cart = $this->repo->fetch($cmd->id);
        $cart->checkout();
        $this->repo->store($cart);
    }
}