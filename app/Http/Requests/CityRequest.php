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
      'nome' => ['required', 'unique:cities,nome', 'max:50'],
      'ddd' => ['required', 'unique:cities,ddd', 'max:3'],
      'state_id' => ['required', 'exists:states,id'],
    ];
  }
}
