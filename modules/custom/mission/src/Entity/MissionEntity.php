<?php

/* 
 * MissionEntity.php
 * A simple Content Entity with annotations.
 */

namespace Drupal\mission\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Mission entity.
 * 
 * @ContentEntityType(
 *   id = "mission",
 *   label = @Translation("Mission"),
 *   base_table = "mission",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *     "uid" = "uid",
 *     "label" = "name",
 *     "created" = "created",
 *     "changed" = "changed",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer mission types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\mission\MissionListBuilder",
 *     "access" = "Drupal\mission\MissionEntityAccessControlHandler",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\mission\Form\MissionEntityForm",
 *       "add" = "Drupal\mission\Form\MissionEntityForm",
 *       "edit" = "Drupal\mission\Form\MissionEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *        "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/mission/{mission}",
 *     "add-page" = "/mission/add",
 *     "add-form" = "/mission/add/{mission_type}",
 *     "edit-form" = "/mission/{mission}/edit",
 *     "delete-form" = "/mission/{mission}/delete",
 *     "collection" = "/admin/content/missions",
 *   },
 *   bundle_entity_type = "mission_type",
 *   field_ui_base_route = "entity.mission_type.edit_form",
 * )
 */

class MissionEntity extends ContentEntityBase implements MissionEntityInterface {
  
  use EntityChangedTrait;
  
  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }
   
   /**
    * {@inheritdoc}
    */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }
  
    /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }
  
    /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }
  
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    
    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Mission entity.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    $fields['name'] = BaseFieldDefinition::create('string')
       ->setLabel(t('Name'))
       ->setDescription(t('The name of the Mission entity.'))
       ->setSettings([
         'max_length' => 50,
         'text_processing' => 0,
       ])
       ->setDefaultValue('')
       ->setDisplayOptions('view', [
         'label' => 'hidden',
         'type' => 'string',
         'weight' => -4,
       ])
       ->setDisplayOptions('form', [
         'type' => 'string_textfield',
         'weight' => -4,
       ])
       ->setDisplayConfigurable('form', TRUE)
       ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'uid' => \Drupal::currentUser()->id(),
    ];
  }
}

