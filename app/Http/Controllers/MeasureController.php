<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormatData;
use App\Http\Requests\MeasureRequest;
use App\Models\Measure;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MeasureController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // Inclui o relacionamento com Products ao carregar as medidas
    $measures = Measure::orderBy('updated_at', 'desc')->paginate(10);

    return view('content.measure.index', compact('measures'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.measure.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(MeasureRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {
        Measure::create($request->all());
      });

      return to_route('measure.index')->with('success', "Medida cadastrada com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao executar query >>> ' . $ex->getMessage());

      return to_route('measure.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Measure $measure)
  {
    // Detalhamento da medida, se necessário
    return view('content.measure.show', compact('measure'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Measure $measure)
  {
    return view('content.measure.edit', compact('measure'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(MeasureRequest $request, Measure $measure)
  {

    try {
      DB::transaction(function () use ($request, $measure) {
        $measure->update($request->all());
      });

      return to_route('measure.index')->with('success', "Medida alterada com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao atualizar medida >>> ' . $ex->getMessage());

      return to_route('measure.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Measure $measure)
  {
    try {
      $measure->delete();

      return to_route('measure.index')->with('success', "Medida excluída com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao excluir medida >>> ' . $ex->getMessage());

      return to_route('measure.index')->with('failed', 'Ops, algo deu errado ao tentar excluir.');
    }
  }
}
