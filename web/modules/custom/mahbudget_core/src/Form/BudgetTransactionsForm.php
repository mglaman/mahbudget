<?php

namespace Drupal\mahbudget_core\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Budget transactions edit forms.
 *
 * @ingroup mahbudget_core
 */
class BudgetTransactionsForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\mahbudget_core\Entity\BudgetTransactions */
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
        drupal_set_message($this->t('Created the %label Budget transactions.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Budget transactions.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.budget_transactions.canonical', ['budget_transactions' => $entity->id()]);
  }

}
