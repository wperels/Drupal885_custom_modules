<?php

/* 
 * MissionTypeEntity.php
 * A simple Config Entity with annotations.
 */

namespace Drupal\mission\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\mission\Entity\MissionTypeEntityInterface;

/**
 * Defines the Mission Type entity. A configuration entity used to manage
 * bundles for the Mission entity.
 *
 * @ConfigEntityType(
 *   id = "mission_type",
 *   label = @Translation("Mission Type"),
 *   bundle_of = "mission",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "mission_type",
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\mission\MissionTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\mission\Form\MissionTypeEntityForm",
 *       "add" = "Drupal\mission\Form\MissionTypeEntityForm",
 *       "edit" = "Drupal\mission\Form\MissionTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer mission types",
 *   links = {
 *     "canonical" = "/admin/structure/mission_type/{mission_type}",
 *     "add-form" = "/admin/structure/mission_type/add",
 *     "edit-form" = "/admin/structure/mission_type/{mission_type}/edit",
 *     "delete-form" = "/admin/structure/mission_type/{mission_type}/delete",
 *     "collection" = "/admin/structure/mission_type",
 *   }
 * )
 */
class MissionTypeEntity extends ConfigEntityBundleBase implements MissionTypeEntityInterface {
  
  /**
   * The machine name of the mission type.
   * 
   * @var string
   */
  protected $id;
  
  /**
   * The human-readable name of the mission type.
   * 
   * @var string
   */
  protected $label;
  
  /**
   * A brief description of the mission type.
   * 
   * @var type 
   */
  protected $description;
  
  /**
   * 
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }
  
  /**
   * 
   * {@inheritdoc}
   */ 
  public function setDescription($description) {
     $this->description = $description;
     return $this;
   }
  
}