<?php

/* 
 * @file
 * Contains \Drupal\probe_orbit\Controller\OrbitController.
 * 
 * A custom controller used to fetch a custom service
 *  and a core service from the container.
 */

namespace Drupal\probe_orbit\Controller;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\probe_orbit\Space\OrbitGenerator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Custom controller to fetch services.
 */
class OrbitController extends ControllerBase {
  
  private $orbitGenerator;
  private $loggerChannelFactory;
  
  public function __construct(OrbitGenerator $orbitGenerator, LoggerChannelFactoryInterface $loggerChannelFactory) {
      $this->orbitGenerator = $orbitGenerator;
      $this->loggerChannelFactory = $loggerChannelFactory;
    }
  
  /**
   * Get number from URL via the wildcard in routing.yml used in $count.
   * Fetch existing service from the container then log string to Reports/Recent log messages.
   * 
   * @param type $count
   * @return Response
   */
  public function orbit($count) {
      $orbit = $this->orbitGenerator->getOrbit($count);
      $this->loggerChannelFactory->get('default')->debug($orbit);
      
      return new Response($orbit);
    }
  
  public static function create(ContainerInterface $container) {
      $orbitGenerator = $container->get('probe_orbit.orbit_generator');
      $loggerChannelFactory = $container->get('logger.factory');
      return new static ($orbitGenerator, $loggerChannelFactory);
    }
}