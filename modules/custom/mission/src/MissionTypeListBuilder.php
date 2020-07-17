<?php

namespace Drupal\mission;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Class MissionTypeListBuilder
 */
class MissionTypeListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(){
    $header['label'] = $this->t('Label');
    $header['description'] = $this->t('Description');
    $header['id'] = $this->t('Machine name');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\mission\Entity\MissionTypeEntityInterface $entity */
    $row['label'] = $entity->label();
    $row['description'] = $entity->getDescription();
    $row['id'] = $entity->id();

    return $row + parent::buildRow($entity);
  }
}