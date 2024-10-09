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
    return [
      'nome' => ['required', 'unique:measures,nome', 'max:50'],
      'sigla' => ['required', 'unique:measures,sigla', 'max:3']
    ];
  }
}
