<?php

/* 
 * @file
 * Contains \Drupal\space_craft\Annotation\Probe.
 * 
 * An annotation class for the probe plugin type used to provide
 * documentation about the meta-data needed.
 */

namespace Drupal\space_craft\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 *  Defines a probe annotation object.
 *  Demonstrates documenting the various properties that 
 *    can be used in annotations for plugins of this type.
 *
 *  @Annotation
 */
class Probe extends Plugin {
  
  //A string property that holds the description.
  public $description;
  
  //The number of instruments on board the space probe.
  public $instruments;
}