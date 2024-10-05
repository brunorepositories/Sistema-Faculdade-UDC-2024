<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest; // Supondo que exista uma CityRequest para validações
use App\Models\City;
use App\Models\State;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $cities = City::with(['state'])->get(); // Incluindo o relacionamento com o State
    return view('content.city.index', compact('cities'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $states = State::all(); // Puxando os estados para o dropdown de seleção
    return view('content.city.create', compact('states'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CityRequest $request)
  {

    // dd($request->all());
    try {
      DB::transaction(function () use ($request) {
        City::create($request->all());
      });

      return to_route('city.index')->with('success', "Cidade cadastrada com sucesso.");
    } catch (QueryException $ex) {
      Log::debug('Warning - Erro ao executar query >>> ' . $ex);

      return to_route('city.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(City $city)
  {
    // Este método pode ser implementado conforme necessário
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(City $city)
  {
    $states = State::all(); // Para popular a seleção de estados na edição
    return view('content.city.edit', compact('city', 'states'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, City $city)
  {
    $city->fill($request->all());
    $city->save();

    return to_route('city.index')->with('success', "Cidade alterada com sucesso.");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(City $city)
  {
    $city->delete();

    return to_route('city.index')->with('success', "Cidade excluída com sucesso.");
  }
}
