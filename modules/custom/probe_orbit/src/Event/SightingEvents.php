<?php

/* 
 *  Create a custom event, set it equal to a constant.
 *  Dispatch of this event occurs upon submit of 'probe_orbit_form'
 *  Two different methods plus a default method can be triggered.
 *  Custom logic determines which message displays on the page.
 */

namespace Drupal\probe_orbit\Event;

final class SightingEvents {
  const NEW_REPORT = 'probe_orbit.new_sighting_report';
}