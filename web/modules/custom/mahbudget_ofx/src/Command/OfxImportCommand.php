<?php

namespace Drupal\mahbudget_ofx\Command;

use Drupal\commerce_price\Price;
use Drupal\mahbudget_core\Entity\BudgetAccountInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Drupal\Console\Core\Command\Shared\CommandTrait;
use Drupal\Console\Core\Style\DrupalStyle;
use Drupal\Console\Annotations\DrupalCommand;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\mahbudget_ofx\OfxParser;

/**
 * Class OfxImportCommand.
 *
 * @DrupalCommand (
 *     extension="mahbudget_ofx",
 *     extensionType="module"
 * )
 */
class OfxImportCommand extends Command {

  use CommandTrait;

  /**
   * Drupal\Core\Entity\EntityTypeManager definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;
  /**
   * Drupal\mahbudget_ofx\OfxParser definition.
   *
   * @var \Drupal\mahbudget_ofx\OfxParser
   */
  protected $ofxParser;

  /**
   * Constructs a new OfxImportCommand object.
   */
  public function __construct(EntityTypeManager $entity_type_manager, OfxParser $ofx_parser) {
    $this->entityTypeManager = $entity_type_manager;
    $this->ofxParser = $ofx_parser;
    parent::__construct();
  }
  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('ofx:import')
      ->addArgument('file', InputArgument::REQUIRED, $this->trans('commands.ofx.import.arguments.file'))
      ->setDescription($this->trans('commands.ofx.import.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $io = new DrupalStyle($input, $output);

    $account_storage = $this->entityTypeManager->getStorage('budget_account');
    $transaction_storage = $this->entityTypeManager->getStorage('budget_transactions');

    $ofx_data = $this->ofxParser->get($input->getArgument('file'));

    foreach ($ofx_data->bankAccounts as $bankAccount) {
      $account_name = $bankAccount->accountType.$bankAccount->accountNumber;
      /** @var \Drupal\mahbudget_core\Entity\BudgetAccountInterface[] $existing */
      $existing = $account_storage->loadByProperties(['name' => $account_name]);
      if (!empty($existing)) {
        $budget_account = reset($existing);
        $budget_account->setBalance(new Price((string) $bankAccount->balance, 'USD'));
      }
      else {
        $budget_account = $account_storage->create([
          'name' => $account_name,
          'balance' => new Price((string) $bankAccount->balance, 'USD'),
          'type' => strtolower($bankAccount->accountType),
        ]);
      }
      $budget_account->save();

      $statement = $bankAccount->statement;
      foreach ($statement->transactions as $transaction) {
        $transaction_type = \Drupal::getContainer()->get('mahbudget_ofx.transaction_type_resolver');
        $existing = $transaction_storage->loadByProperties(['unique_id' => $transaction->uniqueId]);
        if (empty($existing)) {
          /** @var \Drupal\mahbudget_core\Entity\BudgetTransactionsInterface $entry */
          $entry = $transaction_storage->create([
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

    $io->info($this->trans('commands.ofx.import.messages.success'));
  }
}
