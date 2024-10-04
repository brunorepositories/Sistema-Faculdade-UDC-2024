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
      'nome' => ['required', 'unique:states'],
      'uf' => ['required', 'unique:states'],
      'country_id' => ['required', 'exists:contry, id'],
    ];
  }
}
