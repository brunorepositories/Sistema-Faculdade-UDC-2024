<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {

    if ($this->route('city')) {
      $createOrUpdate = [
        'nome' => "unique:cities,nome," . $this->route('city')->id,
      ];
    } else {
      $createOrUpdate = [
        'nome' => "unique:cities,nome",
      ];
    }


    return [
      'nome' => ['required', $createOrUpdate['nome'], 'max:50'],
      'ddd' => ['required', 'max:3'],
      'state_id' => ['required', 'exists:states,id'],
      'ativo' => ['required', 'boolean'],
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'nome' => strtoupper($this->nome),
    ]);
  }
}
