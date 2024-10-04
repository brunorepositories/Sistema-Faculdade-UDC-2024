<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

      return to_route('country.index')->with('success', "Pais cadastrado com sucesso.");
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
    return view('content.country.edit', compact('country'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Country $country)
  {
    $country->fill($request->all());
    $country->save();

    return to_route('country.index')->with('success', "Pais alterado com sucesso.");
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
