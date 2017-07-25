<?php

namespace Drupal\mahbudget_budgets;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Budget entities.
 *
 * @ingroup mahbudget_budgets
 */
class BudgetListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Budget ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mahbudget_budgets\Entity\Budget */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.budget.edit_form',
      ['budget' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
