<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaisRequest;
use App\Models\Pais;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class PaisController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Pais $pais)
  {

    $paises = $pais->all();

    return view('pais.index', compact('paises'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pais.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PaisRequest $request)
  {

    // dd($request->all());

    Pais::create($request->all());

    return to_route('pais.index')->with('failed', 'Ops, algo deu errado, tente novamente!');

    // DB::transaction();
    // try {
    //   $pais = Pais::create($request->all());

    //   dd($pais);

    //   $pais->save();

    //   DB::commit();

    //   return to_route('pais.index', $pais)->with('mensagem.sucesso', "Pais salvo!");
    // } catch (QueryException $exception) {

    //   DB::rollBack();
    //   Log::debug('Warning - Não cadastrar o Client: ' . $exception);

    //   return to_route('pais.index')->with('failed', 'Ops, algo deu errado, tente novamente!');
    // }

    // $pais = DB::transaction(function () use ($request) {
    //   $pais = Pais::create($request->all());

    //   return $pais;
    // });
  }

  /**
   * Display the specified resource.
   */
  public function show(Pais $pais)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Pais $pais)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Pais $pais)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Pais $pais)
  {
    //
  }
}
