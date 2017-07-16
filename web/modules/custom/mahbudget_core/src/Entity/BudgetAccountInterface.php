<?php

namespace Drupal\mahbudget_core\Entity;

use Drupal\commerce_price\Price;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Budget account entities.
 *
 * @ingroup mahbudget_core
 */
interface BudgetAccountInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  const CHECKING = 'checking';
  const SAVINGS = 'savings';
  const MONEYMRKT = 'money_market';
  const CREDITLINE = 'line_of_credit';
  const CD = 'certificate_of_deposit';

  /**
   * Gets the Budget account name.
   *
   * @return string
   *   Name of the Budget account.
   */
  public function getName();

  /**
   * Sets the Budget account name.
   *
   * @param string $name
   *   The Budget account name.
   *
   * @return \Drupal\mahbudget_core\Entity\BudgetAccountInterface
   *   The called Budget account entity.
   */
  public function setName($name);

  /**
   * Gets the Budget account creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Budget account.
   */
  public function getCreatedTime();

  /**
   * Sets the Budget account creation timestamp.
   *
   * @param int $timestamp
   *   The Budget account creation timestamp.
   *
   * @return \Drupal\mahbudget_core\Entity\BudgetAccountInterface
   *   The called Budget account entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Budget account published status indicator.
   *
   * Unpublished Budget account are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Budget account is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Budget account.
   *
   * @param bool $published
   *   TRUE to set this Budget account to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mahbudget_core\Entity\BudgetAccountInterface
   *   The called Budget account entity.
   */
  public function setPublished($published);

  /**
   * @return \Drupal\commerce_price\Price|null
   *   The price, or NULL.
   */
  public function getBalance();

  /**
   * @param \Drupal\commerce_price\Price $price
   *   The price.
   *
   * @return $this
   */
  public function setBalance(Price $price);

}
