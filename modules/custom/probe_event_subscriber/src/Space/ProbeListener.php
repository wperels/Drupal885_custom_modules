<?php

/* 
 * @file
 * Contains \Drupal\probe_event_subscriber\Space\ProbeListener.
 * 
 * An event listener that logs a message.
 */

namespace Drupal\probe_event_subscriber\Space;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class ProbeListener implements EventSubscriberInterface {
  private $loggerChannel;
  
  public function __construct(LoggerChannelFactoryInterface $loggerChannel) {
      $this->loggerChannel = $loggerChannel;
  }
  
  /**
   * to log a message type "?orbit=1" in URL
   * 
   * @param GetResponseEvent $event
   */
  public function onKernelRequest(GetResponseEvent $event) {
     // var_dump $event variable belongs to what object
     #var_dump($event);die();
     $request = $event->getRequest();
     $shouldOrbit = $request->query->get('orbit');
     
     // look under admin/Reports/Recent log messages 
     if ($shouldOrbit) {
         $channel = $this->loggerChannel->get('default')
           ->debug('OrBIT!');
      }
  }
  
  /**
   * 
   * @return type 
   * KernelEvents::REQUEST; // The REQUEST event 
   *  occurs at the very beginning of request dispatching.
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::REQUEST => 'onKernelRequest',
    ];
    
  }
}

  