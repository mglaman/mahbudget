<?php

namespace Drupal\mahbudget_ofx\Command;

use Drupal\mahbudget_ofx\OfxImporter;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Drupal\Console\Core\Command\Shared\CommandTrait;
use Drupal\Console\Core\Style\DrupalStyle;
use Drupal\Console\Annotations\DrupalCommand;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\mahbudget_ofx\OfxParser;
use Symfony\Component\Finder\Finder;

/**
 * Class OfxImportAllCommand.
 *
 * @DrupalCommand (
 *     extension="mahbudget_ofx",
 *     extensionType="module"
 * )
 */
class OfxImportAllCommand extends Command {

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
      ->setName('ofx:import:all')
      ->setDescription($this->trans('commands.ofx.import.all.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $io = new DrupalStyle($input, $output);

    $finder = new Finder();
    $finder->files()
      ->in(\Drupal::root() . '/../private')
      ->depth('< 4')
      ->name('/\.ofx$/');

    $io->info(sprintf('Importing %s files', $finder->count()));
    foreach ($finder as $file) {
      $io->comment(sprintf('Importing %s', $file->getFilename()));
      $this->ofxImporter->import($file->getRealPath());
      sleep(1);
    }

    $io->info($this->trans('commands.ofx.import.all.messages.success'));
  }
}
