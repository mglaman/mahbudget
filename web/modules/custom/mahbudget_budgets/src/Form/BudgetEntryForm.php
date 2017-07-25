<?php

namespace Drupal\mahbudget_budgets\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Budget entry edit forms.
 *
 * @ingroup mahbudget_budgets
 */
class BudgetEntryForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\mahbudget_budgets\Entity\BudgetEntry */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Budget entry.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Budget entry.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.budget_entry.canonical', ['budget_entry' => $entity->id()]);
  }

}
