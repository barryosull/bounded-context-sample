<?php

namespace Domain\Shopping\Aggregate\Cart;

interface Queryable {
 
    public function item(Identifier $id);
    
    public function id();
    
    public function has_item(Identifier$id);
    
    public function number_of_items();
    
    public function is_checked_out();
}