<?php

namespace Drupal\mahbudget_budgets\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Budget entities.
 *
 * @ingroup mahbudget_budgets
 */
interface BudgetInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Budget name.
   *
   * @return string
   *   Name of the Budget.
   */
  public function getName();

  /**
   * Sets the Budget name.
   *
   * @param string $name
   *   The Budget name.
   *
   * @return \Drupal\mahbudget_budgets\Entity\BudgetInterface
   *   The called Budget entity.
   */
  public function setName($name);

  /**
   * Gets the Budget creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Budget.
   */
  public function getCreatedTime();

  /**
   * Sets the Budget creation timestamp.
   *
   * @param int $timestamp
   *   The Budget creation timestamp.
   *
   * @return \Drupal\mahbudget_budgets\Entity\BudgetInterface
   *   The called Budget entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Budget published status indicator.
   *
   * Unpublished Budget are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Budget is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Budget.
   *
   * @param bool $published
   *   TRUE to set this Budget to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mahbudget_budgets\Entity\BudgetInterface
   *   The called Budget entity.
   */
  public function setPublished($published);

}
