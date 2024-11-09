<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormatData;
use App\Http\Requests\StateRequest; // Supondo que exista uma StateRequest para validações
use App\Models\State;
use App\Models\Country; // Adicionando o modelo de Country
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StateController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $states = State::with(['country'])->get(); // Incluindo o relacionamento com o Country

    return view('content.state.index', compact('states'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $countries = Country::all(); // Puxando os países para o dropdown de seleção
    return view('content.state.create', compact('countries'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StateRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {


        $upperCasedData = FormatData::toUpperCaseArray($request->all(), ['nome', 'uf']);

        State::create($upperCasedData);
      });

      return to_route('state.index')->with('success', "Estado cadastrado com sucesso.");
    } catch (QueryException $ex) {

      Log::debug('Warning - Erro ao executar query >>> ' . $ex);

      return to_route('state.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(State $state)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(State $state)
  {
    $countries = Country::all(); // Para popular a seleção de países na edição

    // dd($state->country); // Verificando se o relacionamento está funcionando
    return view('content.state.edit', compact('state', 'countries'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StateRequest $request, State $state)
  {

    try {
      //code...
      $upperCasedData = FormatData::toUpperCaseArray($request->all(), ['nome', 'uf']);

      $state->update($upperCasedData);

      // dd($state);

      return to_route('state.index')->with('success', "Estado alterado com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao atualizar medida >>> ' . $ex->getMessage());

      return to_route('state.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(State $state)
  {
    $state->delete();

    return to_route('state.index')->with('success', "Estado excluído com sucesso.");
  }
}
