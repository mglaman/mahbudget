<?php

namespace Drupal\mahbudget_ofx;

use Drupal\commerce_price\Price;
use Drupal\Core\Entity\EntityTypeManagerInterface;

class OfxImporter {

  protected $ofxParser;
  protected $accountStorage;
  protected $transactionStorage;

  public function __construct(OfxParser $ofx_Parser, EntityTypeManagerInterface $entity_type_manager) {
    $this->ofxParser = $ofx_Parser;
    $this->accountStorage = $entity_type_manager->getStorage('budget_account');
    $this->transactionStorage = $entity_type_manager->getStorage('budget_transactions');
  }

  public function import($file) {
    $ofx_data = $this->ofxParser->get($file);

    foreach ($ofx_data->bankAccounts as $bankAccount) {
      $account_name = $bankAccount->accountType.$bankAccount->accountNumber;
      /** @var \Drupal\mahbudget_core\Entity\BudgetAccountInterface[] $existing */
      $existing = $this->accountStorage->loadByProperties(['name' => $account_name]);
      if (!empty($existing)) {
        $budget_account = reset($existing);
        $budget_account->setBalance(new Price((string) $bankAccount->balance, 'USD'));
      }
      else {
        $budget_account = $this->accountStorage->create([
          'name' => $account_name,
          'balance' => new Price((string) $bankAccount->balance, 'USD'),
          'type' => strtolower($bankAccount->accountType),
        ]);
      }
      $budget_account->save();

      $statement = $bankAccount->statement;
      foreach ($statement->transactions as $transaction) {
        $transaction_type = \Drupal::getContainer()->get('mahbudget_ofx.transaction_type_resolver');
        $existing = $this->transactionStorage->loadByProperties(['unique_id' => $transaction->uniqueId]);
        if (empty($existing)) {
          /** @var \Drupal\mahbudget_core\Entity\BudgetTransactionsInterface $entry */
          $entry = $this->transactionStorage->create([
            'account_id' => $budget_account->id(),
            'user_id' => $budget_account->getOwnerId(),
            'name' => $transaction->memo,
            'type' => $transaction_type->resolve($transaction),
            'amount' => new Price((string) $transaction->amount, 'USD'),
            'created' => $transaction->date->getTimestamp(),
            'unique_id' => $transaction->uniqueId,
          ]);
        }
        else {
          $entry = reset($existing);
          $entry->get('type')->setValue($transaction_type->resolve($transaction));
        }
        $entry->save();
      }
    }
  }

}
