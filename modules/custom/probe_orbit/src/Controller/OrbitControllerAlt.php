<?php

/* 
 * Alternative method to register the controller as a service
 *  then refer to it in the routing.yml.
 *  No need for the __construct function.
 */

namespace Drupal\probe_orbit\Controller;

use Symfony\Component\HttpFoundation\Response;
use Drupal\probe_orbit\Space\OrbitGeneratorAlt;
use Drupal\Core\Controller\ControllerBase;

class OrbitControllerAlt extends ControllerBase
{
  private $orbitGeneratorAlt;
  
//  public function __construct(OrbitGeneratorAlt $orbitGeneratorAlt) 
//    {
//      $this->orbitGeneratorAlt = $orbitGeneratorAlt;
//    }
  
  public function orbitAlt($count) 
    {
      $orbitGeneratorAlt = new OrbitGeneratorAlt;
      $orbitalt = $orbitGeneratorAlt->getOrbitalt($count);
      return new Response($orbitalt);
    }
}