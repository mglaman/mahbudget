<?php

/**
 * @file
 * Contains budget_entry.page.inc.
 *
 * Page callback for Budget entry entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Budget entry templates.
 *
 * Default template: budget_entry.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_budget_entry(array &$variables) {
  // Fetch BudgetEntry Entity Object.
  $budget_entry = $variables['elements']['#budget_entry'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
