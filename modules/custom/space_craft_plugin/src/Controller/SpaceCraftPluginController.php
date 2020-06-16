<?php

namespace Drupal\space_craft_plugin\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\space_craft\ProbePluginManager;

/**
 * Class SpaceCraftPluginController.
 */
class SpaceCraftPluginController extends ControllerBase {

  /**
   * Drupal\space_craft\ProbePluginManager definition.
   *
   * @var \Drupal\space_craft\ProbePluginManager
   */
  protected $pluginManagerProbe;

  /**
   * Constructs a new SpaceCraftPluginController object.
   */
  public function __construct(ProbePluginManager $plugin_manager_probe) {
    $this->pluginManagerProbe = $plugin_manager_probe;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.probe')
    );
  }

  /**
   * Description.
   *
   * @return string
   *   Return Hello string.
   */
  public function description() {
    $build = [];
    
    $build['intro'] = [
      '#markup' => $this->t("This page lists the probe plugins."),
    ];
    
    // Get the list of all the probe plugins defined on the system from the
    // plugin manager. Note that at this point, what we have is *definitions* of
    // plugins, not the plugins themselves.
    $probe_plugin_definitions = $this->pluginManagerProbe->getDefinitions();
    
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
    $mars2020_probe_plugin_definition = $this->pluginManagerProbe->getDefinition('mars2020_probe');
    
    // To get an instance of a plugin, call createInstance() on the plugin
    // manager, passing the ID of the plugin to be load.
    $items = [];
    $extras = [' the fuel source is plutonium-238', ' and communications package. '];
    
    foreach ($probe_plugin_definitions as $plugin_id => $probe_plugin_definition) {
      $plugin = $this->pluginManagerProbe->createInstance($plugin_id, ['of' => 'configuration values']);
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

}
