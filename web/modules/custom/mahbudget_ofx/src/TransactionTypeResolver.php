<?php

namespace Drupal\mahbudget_ofx;

use OfxParser\Entities\Transaction;

class TransactionTypeResolver {

  public function resolve(Transaction $transaction) {
    $type = strtolower($transaction->type);

    if (preg_match('/(((to|from) share)|fi2fi)/i', $transaction->memo) === 1) {
      $type = 'xfer';
    }
    elseif (preg_match('/type deposit/i', $transaction->memo) === 1) {
      $type = 'dep';
    }
    elseif (preg_match('/Annual Percentage Yield Earned/i', $transaction->memo) === 1) {
      $type = 'int';
    }
    return $type;
  }

}
