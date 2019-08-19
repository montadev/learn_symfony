<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event)
    {
        dump('bonjour');
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        //$response = new Response('hello word');

        //$event->setResponse($response);

        
    }

    public static function getSubscribedEvents()
    {
        return [
           'bonjour' => 'onVideoCreatedEvent',
           KernelEvents::RESPONSE =>'onKernelResponse'
        ];
    }
}
