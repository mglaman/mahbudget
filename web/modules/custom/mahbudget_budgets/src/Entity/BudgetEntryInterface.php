<?php

namespace Drupal\mahbudget_budgets\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Budget entry entities.
 *
 * @ingroup mahbudget_budgets
 */
interface BudgetEntryInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Budget entry name.
   *
   * @return string
   *   Name of the Budget entry.
   */
  public function getName();

  /**
   * Sets the Budget entry name.
   *
   * @param string $name
   *   The Budget entry name.
   *
   * @return \Drupal\mahbudget_budgets\Entity\BudgetEntryInterface
   *   The called Budget entry entity.
   */
  public function setName($name);

  /**
   * Gets the Budget entry creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Budget entry.
   */
  public function getCreatedTime();

  /**
   * Sets the Budget entry creation timestamp.
   *
   * @param int $timestamp
   *   The Budget entry creation timestamp.
   *
   * @return \Drupal\mahbudget_budgets\Entity\BudgetEntryInterface
   *   The called Budget entry entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Budget entry published status indicator.
   *
   * Unpublished Budget entry are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Budget entry is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Budget entry.
   *
   * @param bool $published
   *   TRUE to set this Budget entry to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mahbudget_budgets\Entity\BudgetEntryInterface
   *   The called Budget entry entity.
   */
  public function setPublished($published);

}
