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
    return [
      'nome' => ['required', 'unique:cities'],
      'ddd' => ['required', 'unique:cities'],
      'state_id' => ['required', 'exists:states,id'],
    ];
  }
}
