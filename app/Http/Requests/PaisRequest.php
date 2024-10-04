<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaisRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {
    return [
      'nome' => ['required', 'unique:pais'],
      'sigla' => ['required', 'unique:pais'],
      'ddi' => ['required', 'integer']
    ];
  }
}
