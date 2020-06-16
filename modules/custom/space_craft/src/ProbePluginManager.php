<?php

/* 
 *  A plugin manager for new probe plugins.
 */

namespace Drupal\space_craft;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\space_craft\Annotation\Probe;


class ProbePluginManager extends DefaultPluginManager {
  
  /**
   *  Creates the discovery object.
   * 
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.

   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler  ) {
    // Replace the $subdir parameter with subdirectories value for saved plugins.
    $subdir = 'Plugin/Probe';
    
    // The name of the interface that plugins should adhere to.
    $plugin_interface = ProbeInterface::class;
    
    // The name of the annotation class that contains the plugin definition.
    $plugin_definition_annotation_name = Probe::class;
    
    /**
     *  NetBeans hint; Parent construct not called, populated arguments.
     */
    parent::__construct($subdir, $namespaces, $module_handler, $plugin_interface, $plugin_definition_annotation_name);
      // Allows the plugin definitions to be altered by an alter hook.
      $this->alterInfo('probe_info');
      
      // Sets the caching method for our plugin definitions.
      $this->setCacheBackend($cache_backend, 'probe_info');
    
  }
}