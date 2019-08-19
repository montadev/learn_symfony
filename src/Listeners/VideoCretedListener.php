<?php

namespace App\Listeners;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class VideoCretedListener {


  public function onVideoCreatedEvent($event){

       dump($event->event);
       die('hello');
  }
    
}