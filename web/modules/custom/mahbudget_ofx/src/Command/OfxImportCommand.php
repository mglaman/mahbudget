<?php

namespace Drupal\mahbudget_ofx\Command;

use Drupal\commerce_price\Price;
use Drupal\mahbudget_core\Entity\BudgetAccountInterface;
use Drupal\mahbudget_ofx\OfxImporter;
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
   * @var \Drupal\mahbudget_ofx\OfxImporter
   */
  protected $ofxImporter;

  /**
   * Constructs a new OfxImportCommand object.
   */
  public function __construct(OfxImporter $qfxImporter) {
    $this->ofxImporter = $qfxImporter;
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
    $this->ofxImporter->import($input->getArgument('file'));
    $io->info($this->trans('commands.ofx.import.messages.success'));
  }
}
