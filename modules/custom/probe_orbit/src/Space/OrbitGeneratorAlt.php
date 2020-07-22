<?php

/* 
 * @file
 * Contains \Drupal\probe_orbit\Space\OrbitGeneratorAlt.
 * 
 * Explores a method to pass services into the controller 
 *  without needing to use the create function.
 */

namespace Drupal\probe_orbit\Space;

/**
 *  Generates the string used by the controller.
 */
class OrbitGeneratorAlt {
  public function getOrbitalt($length) 
    {
      $string = 'O'.str_repeat('R', $length).'bit!';
      return $string;
    }
}

