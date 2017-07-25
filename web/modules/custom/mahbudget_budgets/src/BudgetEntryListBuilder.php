<?php

namespace Drupal\mahbudget_budgets;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Budget entry entities.
 *
 * @ingroup mahbudget_budgets
 */
class BudgetEntryListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Budget entry ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mahbudget_budgets\Entity\BudgetEntry */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.budget_entry.edit_form',
      ['budget_entry' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
