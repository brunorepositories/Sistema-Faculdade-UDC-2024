<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Helpers\FormatData;

class CountryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Country $country)
  {

    $countries = $country->all();

    return view('content.country.index', compact('countries'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // dd($country);
    return view('content.country.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CountryRequest $request)
  {

    try {
      DB::transaction(function () use ($request) {

        Country::create($request->all());
      });

      return to_route('country.index')->with('success', "País cadastrado com sucesso.");
    } catch (QueryException $ex) {
      Log::debug('Warning - Erro ao executar query >>> ' . $ex);

      return to_route('country.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Country $country)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Country $country)
  {

    // dd($country);
    return view('content.country.edit', compact('country'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CountryRequest $request, Country $country)
  {

    try {

      DB::transaction(function () use ($request, $country) {
        $country->update($request->all());
      });

      return to_route('country.index')->with('success', "Pais alterado com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao atualizar medida >>> ' . $ex->getMessage());

      return to_route('country.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Country $country)
  {

    $country->delete();

    return to_route('country.index')->with('success', "Pais excluído com sucesso.");
  }
}
