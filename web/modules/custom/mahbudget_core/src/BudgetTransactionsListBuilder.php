<?php

namespace Drupal\mahbudget_core;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Budget transactions entities.
 *
 * @ingroup mahbudget_core
 */
class BudgetTransactionsListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Budget transactions ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mahbudget_core\Entity\BudgetTransactions */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.budget_transactions.edit_form',
      ['budget_transactions' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
