<?php

namespace App\Http\Helpers;

class FormatData
{

  /**
   * Converte os valores para uppercase de acordo com os campos especificados.
   *
   * @param array $data - Dados recebidos do request.
   * @param array $fields - Campos que devem ser convertidos para uppercase.
   * @return array - Dados modificados.
   */

  public static function toUpperCaseArray(array $data, array $fields)
  {
    foreach ($fields as $field) {
      if (isset($data[$field])) {
        $data[$field] = strtoupper($data[$field]);
      }
    }

    return $data;
  }

  public static function toUpperCase(string $field)
  {

    return strtoupper($field);
  }
}
