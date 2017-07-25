<?php

namespace Drupal\mahbudget_budgets;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Budget entity.
 *
 * @see \Drupal\mahbudget_budgets\Entity\Budget.
 */
class BudgetAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mahbudget_budgets\Entity\BudgetInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished budget entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published budget entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit budget entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete budget entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add budget entities');
  }

}
