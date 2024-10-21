<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {

    if ($this->route('state')) {
      $createOrUpdate = [
        'nome' => "unique:states,nome," . $this->route('state')->id,
        'uf' => "unique:states,uf," . $this->route('state')->id,
      ];
    } else {
      $createOrUpdate = [
        'nome' => "unique:states,nome",
        'uf' => "unique:states,uf",
      ];
    }


    return [
      'nome' => ['required', $createOrUpdate['nome'], 'max:50'],
      'uf' => ['required', $createOrUpdate['uf'], 'max:2'],
      'country_id' => ['required', 'exists:countries,id'],
    ];
  }
}
