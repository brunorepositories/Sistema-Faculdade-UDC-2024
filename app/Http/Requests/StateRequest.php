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
    return [
      'nome' => ['required', 'unique:states,nome', 'max:50'],
      'uf' => ['required', 'unique:states,uf', 'max:2'],
      'country_id' => ['required', 'exists:countries,id'],
    ];
  }
}
