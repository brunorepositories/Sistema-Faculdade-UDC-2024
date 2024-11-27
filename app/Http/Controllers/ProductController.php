<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormatData;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Measure;
use App\Models\Supplier;
use GuzzleHttp\Psr7\Response;
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

      $query->where('nome', 'LIKE', '%' . strtoupper($search) . '%');
    }

    $products = $query->with('measure', 'supplier')->orderBy('updated_at', 'desc')->paginate(10);

    return view('content.product.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // Recupera todas as medidas (Measure) para o dropdown
    $measures = Measure::where('ativo', true)
      ->orderBy('id')
      ->get();

    // Recupera todas as medidas (Measure) para o dropdown
    $suppliers = Supplier::where('ativo', true)
      ->orderBy('id')
      ->get();

    return view('content.product.create', compact('measures', 'suppliers'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProductRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {

        Product::create($request->all()); // Cria o produto com dados validados
      });

      return to_route('product.index')->with('success', 'Produto cadastrado com sucesso.');
    } catch (QueryException $ex) {
      Log::error('Erro ao cadastrar produto: ' . $ex->getMessage());

      return to_route('product.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  public function export()
  {
    $products = Product::with(['measure', 'supplier'])->get(); // Carrega as relações necessárias

    // Cabeçalhos do CSV correspondentes às colunas da migrate
    $csvData = [];
    $csvData[] = [
      'Código',
      'Nome',
      'Estoque',
      'Preço de Custo',
      'Custo da Última Compra',
      'Data da Última Compra',
      'Preço de Venda',
      'Custo da Última Venda',
      'Data da Última Venda',
      'Ativo',
      'Medida',
      'Fornecedor'
    ];

    // Adiciona os dados do produto ao CSV
    foreach ($products as $product) {
      $csvData[] = [
        $product->id,
        $product->nome,
        $product->estoque,
        number_format($product->precoCusto, 2, ',', '.'),
        number_format($product->custoUltimaCompra, 2, ',', '.'),
        $product->dtUltimaCompra ? \Carbon\Carbon::parse($product->dtUltimaCompra)->format('d/m/Y H:i') : '-',
        number_format($product->precoVenda, 2, ',', '.'),
        number_format($product->precoUltimaVenda, 2, ',', '.'),
        $product->dtUltimaVenda ? \Carbon\Carbon::parse($product->dtUltimaVenda)->format('d/m/Y H:i') : '-',
        $product->ativo ? 'Sim' : 'Não',
        $product->measure->nome . ' (' . $product->measure->sigla . ')', // Nome e sigla da medida
        $product->supplier->nome ?? '-' // Nome do fornecedor, caso exista
      ];
    }

    // Gera o arquivo CSV
    $filename = 'produtos-export_' . now()->format('dmY-Hi') . '.csv';
    $handle = fopen('php://temp', 'w');
    foreach ($csvData as $row) {
      fputcsv($handle, $row, ';');
    }
    rewind($handle);
    $content = stream_get_contents($handle);
    fclose($handle);

    // Retorna a resposta como arquivo para download
    return response($content)
      ->header('Content-Type', 'text/csv')
      ->header('Content-Disposition', "attachment; filename=\"$filename\"");
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
    $measures = Measure::where('ativo', true)
      ->orderBy('id')

      ->get();
    // Recupera todas as medidas (Measure) para o dropdown
    $suppliers = Supplier::where('ativo', true)
      ->orderBy('id')
      ->get();


    return view('content.product.edit', compact('product', 'suppliers', 'measures'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ProductRequest $request, Product $product)
  {
    try {

      // dd($request->all());
      DB::transaction(function () use ($request, $product) {

        $product->update($request->all()); // Atualiza o produto com dados validados

        // dd($product);
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
