<?php

/**
 * @file
 * Contains budget.page.inc.
 *
 * Page callback for Budget entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Budget templates.
 *
 * Default template: budget.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_budget(array &$variables) {
  // Fetch Budget Entity Object.
  $budget = $variables['elements']['#budget'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
