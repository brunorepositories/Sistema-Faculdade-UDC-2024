<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\City;
use App\Models\PaymentTerm;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = Supplier::query();

    if ($search = $request->input('search')) {

      $query->where('fornecedorRazaoSocial', 'LIKE', '%' . strtoupper($search) . '%');
    }

    $suppliers = $query->orderBy('updated_at', 'desc')->paginate(10);

    return view('content.supplier.index', compact('suppliers'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(City $cities, PaymentTerm $paymentTerms)
  {

    $cities = City::all();
    $paymentTerms = PaymentTerm::all();

    return view('content.supplier.create', compact('cities', 'paymentTerms'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SupplierRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {
        $supplierData = $request->only([
          'tipoPessoa',
          'fornecedorRazaoSocial',
          'apelidoNomeFantasia',
          'endereco',
          'bairro',
          'numero',
          'cep',
          'complemento',
          'sexo',
          'email',
          'usuario',
          'telefone',
          'celular',
          'nomeContato',
          'dataNasc',
          'cpfCnpj',
          'rgIe',
          'ativo',
          'city_id',
          'payment_term_id',
        ]);

        Supplier::create($supplierData);
      });

      return to_route('supplier.index')->with('success', "Fornecedor cadastrado com sucesso.");
    } catch (QueryException $th) {
      Log::error('Erro ao cadastrar fornecedor: ' . $th->getMessage());
      return to_route('supplier.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  public function export()
  {
    $purchases = Purchase::with(['supplier', 'paymentTerm'])->get(); // Carrega as relações necessárias

    // Cabeçalhos do CSV correspondentes às colunas da migrate de purchases
    $csvData = [];
    $csvData[] = [
      'Código',
      'Número da Nota',
      'Modelo',
      'Série',
      'Fornecedor',
      'Data Emissão',
      'Data Chegada',
      'Tipo de Frete',
      'Valor Frete',
      'Valor Seguro',
      'Outras Despesas',
      'Total Produtos',
      'Total a Pagar',
      'Condição de Pagamento',
      'Observação',
      'Data Cancelamento'
    ];

    // Adiciona os dados das compras ao CSV
    foreach ($purchases as $purchase) {
      $csvData[] = [
        $purchase->id,
        $purchase->numeroNota,
        $purchase->modelo,
        $purchase->serie,
        $purchase->supplier->fornecedorRazaoSocial ?? '-', // Nome do fornecedor
        $purchase->dataEmissao->format('d/m/Y'),
        $purchase->dataChegada->format('d/m/Y'),
        $purchase->tipoFrete ? 'Frete Pago' : 'Frete a Pagar', // Traduz tipo de frete (booleano)
        number_format($purchase->valorFrete ?? 0, 2, ',', '.'),
        number_format($purchase->valorSeguro ?? 0, 2, ',', '.'),
        number_format($purchase->outrasDespesas ?? 0, 2, ',', '.'),
        number_format($purchase->totalProdutos, 2, ',', '.'),
        number_format($purchase->totalPagar, 2, ',', '.'),
        $purchase->paymentTerm->descricao ?? '-', // Termos de pagamento
        $purchase->observacao ?? '-', // Observações
        $purchase->data_cancelamento ? $purchase->data_cancelamento->format('d/m/Y') : '-' // Data de cancelamento
      ];
    }

    // Gera o arquivo CSV
    $filename = 'compras-export_' . now()->format('dmY-Hi') . '.csv';
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
  public function show(Supplier $supplier)
  {
    return view('content.supplier.show', compact('supplier'));
  }


  public function findId($id)
  {
    // Tenta encontrar o fornecedor pelo ID
    $supplier = Supplier::find($id);

    // Verifica se o fornecedor foi encontrado
    if ($supplier) {
      return response()->json([
        'success' => true,
        'message' => 'Fornecedor encontrado.',
        'exists' => true,
        'supplier' => $supplier
      ], 200);
    }

    // Se não encontrar o fornecedor, retorna uma mensagem de erro
    return response()->json([
      'success' => false,
      'message' => 'Nenhum registro encontrado.',
      'exists' => false,
      'supplier' => null
    ], 404);
  }



  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Supplier $supplier)
  {
    $cities = City::all();
    $paymentTerms = PaymentTerm::all();

    return view('content.supplier.edit', compact('supplier', 'cities', 'paymentTerms'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(SupplierRequest $request, Supplier $supplier)
  {
    try {
      $supplier->update($request->only([
        'tipoPessoa',
        'fornecedorRazaoSocial',
        'apelidoNomeFantasia',
        'endereco',
        'bairro',
        'numero',
        'cep',
        'complemento',
        'sexo',
        'email',
        'usuario',
        'telefone',
        'celular',
        'nomeContato',
        'dataNasc',
        'cpfCnpj',
        'rgIe',
        'ativo',
        'city_id',
        'payment_term_id',
      ]));

      return to_route('supplier.index')->with('success', 'Fornecedor atualizado com sucesso.');
    } catch (QueryException $th) {
      Log::error('Erro ao atualizar fornecedor: ' . $th->getMessage());
      return to_route('supplier.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Supplier $supplier)
  {
    try {
      $supplier->delete();
      return to_route('supplier.index')->with('success', 'Fornecedor excluído com sucesso.');
    } catch (QueryException $th) {
      Log::error('Erro ao excluir fornecedor: ' . $th->getMessage());
      return to_route('supplier.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  public function buscar(Request $request)
  {
    $searchTerm = $request->input('search') ?? '';
    $suppliers = Supplier::where('fornecedorRazaoSocial', 'LIKE', "%{$searchTerm}%")
      ->orWhere('apelidoNomeFantasia', 'LIKE', "%{$searchTerm}%")
      ->paginate(10);

    return response()->json($suppliers);
  }
}
