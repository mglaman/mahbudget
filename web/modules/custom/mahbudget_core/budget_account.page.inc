<?php

/**
 * @file
 * Contains budget_account.page.inc.
 *
 * Page callback for Budget account entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Budget account templates.
 *
 * Default template: budget_account.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_budget_account(array &$variables) {
  // Fetch BudgetAccount Entity Object.
  $budget_account = $variables['elements']['#budget_account'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
