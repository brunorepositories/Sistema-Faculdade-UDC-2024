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
      'nome' => ['required', 'unique:countries,nome', 'max:50'],
      'sigla' => ['required', 'unique:countries,sigla', 'max:3'],
      'ddi' => ['required', 'max:3']
    ];
  }
}
