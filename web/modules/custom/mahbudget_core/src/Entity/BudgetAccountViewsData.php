<?php

namespace Drupal\mahbudget_core\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Budget account entities.
 */
class BudgetAccountViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
