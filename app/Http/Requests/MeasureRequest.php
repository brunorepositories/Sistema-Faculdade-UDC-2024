<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeasureRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {

    if ($this->route('measure')) {
      $createOrUpdate = [
        'nome' => "unique:measures,nome," . $this->route('measure')->id,
        'sigla' => "unique:measures,sigla," . $this->route('measure')->id,
      ];
    } else {
      $createOrUpdate = [
        'nome' => "unique:measures,nome",
        'sigla' => "unique:measures,sigla",
      ];
    }

    return [
      'nome' => ['required', $createOrUpdate['nome'], 'max:50'],
      'sigla' => ['required', $createOrUpdate['sigla'], 'max:6'],
      'ativo' => ['required', 'boolean'],
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'nome' => strtoupper($this->nome),
      'sigla' => strtoupper($this->sigla),
    ]);
  }
}
