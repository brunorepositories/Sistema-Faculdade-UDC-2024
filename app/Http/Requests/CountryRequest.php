<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {

    if ($this->route('country')) {
      $createOrUpdate = [
        'nome' => "unique:countries,nome," . $this->route('country')->id,
        'sigla' => "unique:countries,sigla," . $this->route('country')->id,
      ];
    } else {
      $createOrUpdate = [
        'nome' => "unique:countries,nome",
        'sigla' => "unique:countries,sigla",
      ];
    }

    return [
      'nome' => ['required', $createOrUpdate['nome'], 'max:50'],
      'sigla' => ['required', $createOrUpdate['sigla'], 'max:3'],
      'ddi' => ['required', 'max:3']
    ];
  }
}
