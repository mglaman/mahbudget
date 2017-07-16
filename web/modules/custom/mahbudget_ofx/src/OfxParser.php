<?php

namespace Drupal\mahbudget_ofx;

use OfxParser\Parser as BaseParser;

class OfxParser extends BaseParser {

  /**
   * @param $filename
   *
   * @return \OfxParser\Ofx
   */
  public function get($filename) {
    $parser = new static();
    return $parser->loadFromFile($filename);
  }

}
