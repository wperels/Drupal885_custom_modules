<?php

/* 
 *  Subscribe to SightingEvents::NEW_REPORT events and react to new reports.
 *  Point to two different methods to execute when an event is dispatched.
 *  Use custom logic along with examination of the Event object to determine 
 *    which message to display on the screen then stop propagation of the event.
 */

namespace Drupal\probe_orbit\EventSubscriber;

use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\probe_orbit\Event\SightingEvents;
use Drupal\probe_orbit\Event\SightingReportEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class ProbeEventsSubscriber implements EventSubscriberInterface {
  
  use StringTranslationTrait;
  use MessengerTrait;
  
  public static function getSubscribedEvents() {
    $events[SightingEvents::NEW_REPORT][] = ['notifyNASA'];
    $events[SightingEvents::NEW_REPORT][] = ['notifySETI', -100];
    $events[SightingEvents::NEW_REPORT][] = ['notifyDefault', -255];
    
    return $events;
  }
  
  public function notifyNASA(SightingReportEvent $event) {
    if($event->getType() == 'new_horizons') {
      $this->messenger()->addStatus($this->t('NASA has been alerted. One of the best probes to date has come back to Earth.', ['@method' => __METHOD__]));
      $event->stopPropagation();
    }
  }
  
  public function notifySETI(SightingReportEvent $event) {
    if($event->getType() == 'ufo') {
      $this->messenger()->addStatus($this->t('SETI has been alerted. An Unidentified Flying Object sighting.', ['@method' => __METHOD__]));
      $event->stopPropagation();
    }
  }
  
  public function notifyDefault(SightingReportEvent $event) {
    $this->messenger()->addStatus($this->t('Thank you for reporting this sighting. This message was set by an event subscriber.', ['@method' => __METHOD__]));
    $event->stopPropagation();
  }
}