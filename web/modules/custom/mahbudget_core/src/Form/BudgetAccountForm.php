<?php

namespace Drupal\mahbudget_core\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Budget account edit forms.
 *
 * @ingroup mahbudget_core
 */
class BudgetAccountForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\mahbudget_core\Entity\BudgetAccount */
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
        drupal_set_message($this->t('Created the %label Budget account.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Budget account.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.budget_account.canonical', ['budget_account' => $entity->id()]);
  }

}
