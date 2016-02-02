<?php

namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Event\Stream;

class Factoy 
{    
    public function make_new() 
    {
        $blank_state = new State();
        $empty_event_stream = new Stream();
        return new Aggregate($blank_state, $empty_event_stream);
    }
}