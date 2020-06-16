<?php

/* 
 *  Event Subscriber listens for the kernel.request event.
 *  Uses Logger Factory to log OrBIT! in the default channel.
 *     Must add service tag 'event_subscriber' in services.yml 
*/
namespace Drupal\probe_orbit\Space;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class ProbeListener implements EventSubscriberInterface
{
  private $loggerChannel;
  
  public function __construct(LoggerChannelFactoryInterface $loggerChannel) 
    {
      $this->loggerChannel = $loggerChannel;
    
    }
  public function onKernelRequest(GetResponseEvent $event) 
    {
     # var_dump($event);die();
     $request = $event->getRequest();
     $shouldRoar = $request->query->get('roar');
     
     if ($shouldRoar) 
       {
         $channel = $this->loggerChannel->get('default')
           ->debug('OrBIT!');
       }
    }
  
  public static function getSubscribedEvents() 
    
  {
    return [
      KernelEvents::REQUEST => 'onKernelRequest',
    ];
    
  }
  
  
}

  