<?php

/* 
 * @file
 * Contains \Drupal\probe_orbit\Space\OrbitGenerator.
 * 
 * Access the KeyValueStore service from inside 
 * the OrbitGenerator service to make it cacheable.
 * 
 * Add '@keyvalue' as an argument in the services.yml 
 * to fetch the service from the container.
 */

namespace Drupal\probe_orbit\Space;

use Drupal\Core\KeyValueStore\KeyValueFactoryInterface;

/**
 * Setup a cache then save to the 'probe' collection
 */
class OrbitGenerator {
  private $keyValueFactory;
  
  public function __construct(KeyValueFactoryInterface $keyValueFactory) {
      $this->keyValueFactory = $keyValueFactory;
    }

  public function getOrbit($length) {
      $key = 'orbit_'.$length;
      $store = $this->keyValueFactory->get('probe');
      
      if($store->has($key)) {
          return $store->get($key);
        }
      sleep(2);
      
      $string = 'Or'.str_repeat('B', $length).'it!';
      $store->set($key, $string);
          return $string;
    }
}