<?php

/* 
 * Provides a Mars 2020 probe object.
 */

namespace Drupal\space_craft_plugin\Plugin\Probe;

use Drupal\space_craft\ProbeBase;

/**
 *  @Probe(
 *    id = "mars2020_probe",
 *    description = @Translation("Mars 2020 rover is a nasa Mars rover, twin to Curiosity"),
 *    instruments = 8
 * )
 */

class Mars2020Probe extends ProbeBase {
  
  /**
   *  Override the abstract method in the base class.
   * 
   * @param array $extras
   * @return string
   */
  
  public function order(array $extras) {
    $payload = [' SHERLOC, PIXL, RIMFX, and MOXIE, the SuperCam seeking organic compounds', 'a weather measuring instrument, also'];
    $probe = array_merge($payload, $extras);
    return 'The spacecrafts scientific payload includes; ' . implode(', ', $probe) . ' The spacecraft will also carry a small drone helicopter, an autonomous rotorcraft, called The Mars Helicopter Scout (MHS).';
  }
}