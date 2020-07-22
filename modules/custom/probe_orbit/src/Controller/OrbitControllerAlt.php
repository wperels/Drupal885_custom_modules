<?php

/* 
 * @file
 * Contains \Drupal\probe_orbit\Space\OrbitControllerAlt.
 * 
 * Refer to controller service in the routing.yml. Be sure to watch space/indents in .yml files.
 *  Register OrbitControllerAlt under a service alias (probe_orbit.orbit_controlleralt) in the service.yml. 
 */

namespace Drupal\probe_orbit\Controller;

use Symfony\Component\HttpFoundation\Response;
use Drupal\probe_orbit\Space\OrbitGeneratorAlt;
use Drupal\Core\Controller\ControllerBase;

/**
 * Create a new object to call getOrbitalt and pass in the count variable.
 */
class OrbitControllerAlt extends ControllerBase {
  
  public function orbitAlt($count) {
      $orbitGeneratorAlt = new OrbitGeneratorAlt;
      $orbitalt = $orbitGeneratorAlt->getOrbitalt($count);
      return new Response($orbitalt);
    }
}