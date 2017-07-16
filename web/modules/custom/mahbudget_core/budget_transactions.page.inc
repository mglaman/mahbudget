<?php

/**
 * @file
 * Contains budget_transactions.page.inc.
 *
 * Page callback for Budget transactions entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Budget transactions templates.
 *
 * Default template: budget_transactions.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_budget_transactions(array &$variables) {
  // Fetch BudgetTransactions Entity Object.
  $budget_transactions = $variables['elements']['#budget_transactions'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
