<?php

/* 
 * A unique class to wrap the Event object.
 */

namespace Drupal\probe_orbit\Event;

use Symfony\Component\EventDispatcher\Event;

class SightingReportEvent extends Event {

protected $type;
protected $report;


public function __construct($type, $report) {
  $this->type = $type;
  $this->report = $report;
}
  public function getType() {
    return $this->type;
  }
  
  public function getReport() {
    return $this->report;
  }
}