<?php

/* 
 *  A base class to help developers implement their own probe plugins.
 *  Both the description and instruments properties are read from the @Probe annotation. 
 */

namespace Drupal\space_craft;

use Drupal\Component\Plugin\PluginBase;
use Drupal\space_craft\ProbeInterface;

abstract class ProbeBase extends PluginBase implements ProbeInterface {
  
  /**
   * {@inheritdoc}
   */
  public function description() {
    // Retrieve the @description property from the annotation and return it.
    return $this->pluginDefinition['description'];
  }
  
  /**
   * {@inheritdoc}
   */
  public function instruments() {
    return $this->pluginDefinition['instruments'];
  }
  
  /**
   * {@inheritdoc}
   */
  abstract public function order(array $extras);
}
