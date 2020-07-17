<?php

namespace Drupal\mission\Entity;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mission entity entities.
 *
 * @ingroup mission
 */
interface MissionEntityInterface extends EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Mission entity name.
   *
   * @return string
   *   Name of the Mission entity.
   */
  public function getName();

  /**
   * Sets the Mission entity name.
   *
   * @param string $name
   *   The Mission entity name.
   *
   * @return \Drupal\missionEntity\MissionEntityInterface
   *   The called Mission entity entity.
   */
  public function setName($name);

  /**
   * Gets the Mission entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mission entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Mission entity creation timestamp.
   *
   * @param int $timestamp
   *   The Mission entity creation timestamp.
   *
   * @return \Drupal\mission\Entity\MissionEntityInterface
   *   The called Mission entity entity.
   */
  public function setCreatedTime($timestamp);
}