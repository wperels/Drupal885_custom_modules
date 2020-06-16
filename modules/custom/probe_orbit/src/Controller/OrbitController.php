<?php

/* 
 *  Add wildcard in routing.yml. Add new Response object.
 *  Add to dependency injection container. 
 *  Fetch custom service then pass to new OrbitController object.
 *  Fetch existing service from the container then log string to Reports/Recent log messages.
 */

namespace Drupal\probe_orbit\Controller;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\probe_orbit\Space\OrbitGenerator;
use Symfony\Component\HttpFoundation\Response;



class OrbitController extends ControllerBase
{
  private $orbitGenerator;
  private $loggerChannelFactory;
  
  public function __construct(OrbitGenerator $orbitGenerator, LoggerChannelFactoryInterface $loggerChannelFactory) 
    {
      $this->orbitGenerator = $orbitGenerator;
      $this->loggerChannelFactory = $loggerChannelFactory;
    }
  public function orbit($count) 
    {
      #$orbitGenerator = new orbitGenerator;
      $orbit = $this->orbitGenerator->getOrbit($count);
      $this->loggerChannelFactory->get('default')->debug($orbit);
      
      return new Response($orbit);
    }
  
  public static function create(ContainerInterface $container) 
    {
      $orbitGenerator = $container->get('probe_orbit.orbit_generator');
      $loggerChannelFactory = $container->get('logger.factory');
      return new static ($orbitGenerator, $loggerChannelFactory);
    }
}