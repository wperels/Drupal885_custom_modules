<?php

/* 
 *  Controller for probe example pages.
 */

namespace Drupal\space_craft\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\space_craft\ProbePluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SpaceCraftController extends ControllerBase {
  
  protected $probeManager;
  
  /**
   * 
   * @param ProbePluginManager $probe_manager
   *   The probe plugin manager service. Injecting this service so that
   *   it can used to access the probe plugins.
   */
  public function __construct(ProbePluginManager $probe_manager) {
    $this->probeManager = $probe_manager;
  }
  
  /**
   * Displays a page with an overview of our plugin type and plugins.
   * 
   * @return array
   *   Render API array with content at this path
   *   /space_craft.
   */
  public function description() {
    $build = [];
    
    $build['intro'] = [
      '#markup' => $this->t("This page lists the probe plugins."),
    ];
    
    // Get the list of all the probe plugins defined on the system from the
    // plugin manager. Note that at this point, what we have is *definitions* of
    // plugins, not the plugins themselves.
    $probe_plugin_definitions = $this->probeManager->getDefinitions();
    
    $items = [];
    foreach ($probe_plugin_definitions as $probe_plugin_definition) {
      $items[] = $this->t("@id (Instruments: @instruments, Description: @description )",[
        '@id' => $probe_plugin_definition['id'],
        '@instruments' => $probe_plugin_definition['instruments'],
        '@description' => $probe_plugin_definition['description'],
      ]);
    }
    
    // Render array for the page output.
    $build['plugin_definitions'] = [
      '#theme' => 'item_list',
      '#title' => 'Probe plugin definitions',
      '#items' => $items,
    ];
    
    // For a single plugin definition, use getDefinition().
    // This requires the ID of the plugin set in the annotation on the plugin class.
    $juno_probe_plugin_definition = $this->probeManager->getDefinition('juno_probe');
    
    // To get an instance of a plugin, call createInstance() on the plugin
    // manager, passing the ID of the plugin to be load.
    $items = [];
    $extras = [' a solar array', ' and communications package. '];
    
    foreach ($probe_plugin_definitions as $plugin_id => $probe_plugin_definition) {
      $plugin = $this->probeManager->createInstance($plugin_id, ['of' => 'configuration values']);
      $items[] = $plugin->description() ;
      
      // Add a call to the order() function which is overridden on each probe plugin to include specialized information.
      // the above $extras array contains information common to all plugins, then merged and imploded inside the plugin.
      $items[] = $plugin->order($extras);
    }
    
    $build['plugins'] = [
      '#theme' => 'item_list',
      '#title' => 'Probe plugins',
      '#items' => $items,
    ];

    return $build;
  }
  
  /**
   *  Dependency injection override the parent method
   *   inject the probe plugin manager service into the controller.
   * 
   * @param ContainerInterface $container
   * @return \static as defined in the space_craft.services.yml file.
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('plugin.manager.probe'));
  }
}