<?php

/* 
 *  An interface for all probe type plugins.
 */

namespace Drupal\space_craft;

interface ProbeInterface {
  /**
   *  @return string
   */
  public function description();
  
  /**
   *  @return int
   */
  public function instruments();
  
  /**
   * 
   * @param array $extras
   * 
   *  @return string
   */
  
  public function order(array $extras);
  
}