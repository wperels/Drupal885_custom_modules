<?php

/* 
 *  Custom service 'probe_orbit.orbit_generator'.
 *  Access the KeyValueStore service from inside 
 *  the ObitGenerator service to make it cacheable.
 */

namespace Drupal\probe_orbit\Space;

use Drupal\Core\KeyValueStore\KeyValueFactoryInterface;

class OrbitGenerator 
{
  private $keyValueFactory;
  
  public function __construct(KeyValueFactoryInterface $keyValueFactory) 
    {
      $this->keyValueFactory = $keyValueFactory;
    }

  public function getOrbit($length) 
    {
      $key = 'orbit_'.$length;
      $store = $this->keyValueFactory->get('probe');
      
      if($store->has($key))
        {
    
          return $store->get($key);
        }
        
      sleep(2);
      
      $string = 'Or'.str_repeat('B', $length).'it!';
      $store->set($key, $string);
      
      return $string;
    }
  
}