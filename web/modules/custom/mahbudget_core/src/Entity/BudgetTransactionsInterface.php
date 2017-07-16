<?php

namespace Drupal\mahbudget_core\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Budget transactions entities.
 *
 * @ingroup mahbudget_core
 */
interface BudgetTransactionsInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Budget transactions name.
   *
   * @return string
   *   Name of the Budget transactions.
   */
  public function getName();

  /**
   * Sets the Budget transactions name.
   *
   * @param string $name
   *   The Budget transactions name.
   *
   * @return \Drupal\mahbudget_core\Entity\BudgetTransactionsInterface
   *   The called Budget transactions entity.
   */
  public function setName($name);

  /**
   * Gets the Budget transactions creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Budget transactions.
   */
  public function getCreatedTime();

  /**
   * Sets the Budget transactions creation timestamp.
   *
   * @param int $timestamp
   *   The Budget transactions creation timestamp.
   *
   * @return \Drupal\mahbudget_core\Entity\BudgetTransactionsInterface
   *   The called Budget transactions entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Budget transactions published status indicator.
   *
   * Unpublished Budget transactions are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Budget transactions is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Budget transactions.
   *
   * @param bool $published
   *   TRUE to set this Budget transactions to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mahbudget_core\Entity\BudgetTransactionsInterface
   *   The called Budget transactions entity.
   */
  public function setPublished($published);

}
