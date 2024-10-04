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
    return [
      'nome' => ['required', 'unique:countries'],
      'sigla' => ['required', 'unique:countries'],
      'ddi' => ['required', 'integer']
    ];
  }
}
