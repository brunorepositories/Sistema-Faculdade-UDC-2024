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
      return [
        'nome' => "unique:countries,nome," . $this->route('country')->id,
        'sigla' => "unique:countries,sigla," . $this->route('country')->id,
        'ddi' => ['required', 'max:3'],
        'ativo' => ['required', 'boolean']
      ];
    } else {
      return [
        'nome' => "unique:countries,nome",
        'sigla' => "unique:countries,sigla",
        'ddi' => ['required', 'max:3'],
        'ativo' => ['required', 'boolean']
      ];
    }
  }

  public function prepareForValidation()
  {
    $this->merge([
      'nome' => strtoupper($this->nome),
      'sigla' => strtoupper($this->sigla),
    ]);
  }

  public function prepareForValidation()
  {
    $this->merge([
      'nome' => strtoupper($this->nome),
    ]);
  }
}
