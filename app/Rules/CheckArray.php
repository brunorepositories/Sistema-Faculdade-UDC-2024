<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckArray implements ValidationRule
{
  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $decodedArray = json_decode($value, true);

    if (! is_array($decodedArray)) {
      $fail("O campo {$attribute} precisa ser um array válido.");
    }

    if (empty($decodedArray)) {
      $fail("Adicione ao menos um(a) {$attribute}.");
    }
  }
}
