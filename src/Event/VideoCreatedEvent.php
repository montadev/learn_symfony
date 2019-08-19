<?php


namespace App\Event;

use Symfony\Component\EventDispatcher\Event;



class VideoCreatedEvent extends Event{


   public $event; 
public function __construct($event)
{
   $this->event=$event;
}

    
}


