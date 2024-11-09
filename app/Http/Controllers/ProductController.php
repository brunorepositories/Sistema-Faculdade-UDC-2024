<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormatData;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Measure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
      $query = Product::query();

      if ($search = $request->input('search')) {
          $query->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($search) . '%']);
      }

      $products = $query->with('measure')->paginate(10);

      return view('content.product.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // Recupera todas as medidas (Measure) para o dropdown
    $measures = Measure::all();

    return view('content.product.create', compact('measures'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProductRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {


        $upperCasedData = FormatData::toUpperCaseArray($request->all(), ['nome']);

        // dd($upperCasedData);

        Product::create($upperCasedData); // Cria o produto com dados validados

        return to_route('product.index')->with('success', 'Produto cadastrado com sucesso.');
      });
    } catch (QueryException $ex) {
      Log::error('Erro ao cadastrar produto: ' . $ex->getMessage());

      return to_route('product.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    // Mostrar detalhes de um produto específico
    return view('content.product.show', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Product $product)
  {
    // Recupera todas as medidas para a edição do produto
    $measures = Measure::all();

    return view('content.product.edit', compact('product', 'measures'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ProductRequest $request, Product $product)
  {
    try {
      DB::transaction(function () use ($request, $product) {

        $upperCasedData = FormatData::toUpperCaseArray($request->all(), ['nome']);
        $product->update($upperCasedData); // Atualiza o produto com dados validados
      });

      return to_route('product.index')->with('success', 'Produto atualizado com sucesso.');
    } catch (QueryException $ex) {
      Log::error('Erro ao atualizar produto: ' . $ex->getMessage());

      return to_route('product.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    try {
      DB::transaction(function () use ($product) {
        $product->delete(); // Exclui o produto
      });

      return to_route('product.index')->with('success', 'Produto excluído com sucesso.');
    } catch (QueryException $ex) {
      Log::error('Erro ao excluir produto: ' . $ex->getMessage());

      return to_route('product.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }
}
