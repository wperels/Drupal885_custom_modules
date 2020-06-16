<?php

/* 
 * Provides a Juno probe object.
 */

namespace Drupal\space_craft\Plugin\Probe;

use Drupal\space_craft\ProbeBase;

/**
 *  @Probe(
 *    id = "juno_probe",
 *    description = @Translation("Juno is a nasa spacecraft currently orbiting Jupiter"),
 *    instruments = 8
 * )
 */

class JunoProbe extends ProbeBase {
  
  /**
   *  Override the abstract method in the base class.
   * 
   * @param array $extras
   * @return string
   */
  
  public function order(array $extras) {
    $payload = [' JADE & JEDI, radio/plasma experiment', 'a gravity/radio science system, also'];
    $probe = array_merge($payload, $extras);
    return 'The spacecrafts scientific payload includes; ' . implode(', ', $probe) . ' The spacecraft will also carry a color camera, called JunoCam.';
  }
}