<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PaymentTerm;
use App\Models\Product;
use App\Models\PurchaseProducts;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class PurchaseController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Purchase $purchase)
  {

    // $query = Supplier::query();

    // if ($search = $request->input('search')) {

    //   $query->where('', 'LIKE', '%' . strtoupper($search) . '%');
    // }



    $purchases = $purchase->with('paymentTerm', 'supplier')->orderBy('updated_at', 'desc')->paginate(10);


    return view('content.purchase.index', compact('purchases'));
  }

  public function export()
  {
    // Carrega todas as compras com relações necessárias (fornecedor e condição de pagamento)
    $purchases = Purchase::with(['supplier', 'paymentTerm'])->get();

    // Cabeçalhos do CSV correspondentes às colunas da migração
    $csvData = [];
    $csvData[] = [
      'ID',
      'Número da Nota',
      'Modelo',
      'Série',
      'Data de Emissão',
      'Data de Chegada',
      'Tipo de Frete',
      'Valor do Frete',
      'Valor do Seguro',
      'Outras Despesas',
      'Total dos Produtos',
      'Total a Pagar',
      'Observação',
      'Fornecedor',
      'Condição de Pagamento',
      'Data de Cancelamento'
    ];

    // Adiciona os dados das compras ao CSV
    foreach ($purchases as $purchase) {
      $csvData[] = [
        $purchase->id,
        $purchase->numeroNota,
        $purchase->modelo,
        $purchase->serie,
        $purchase->dataEmissao ? \Carbon\Carbon::parse($purchase->dataEmissao)->format('d/m/Y') : '-',
        $purchase->dataChegada ? \Carbon\Carbon::parse($purchase->dataChegada)->format('d/m/Y') : '-',
        $purchase->tipoFrete ? 'CIF' : 'FOB', // Assume que o tipo de frete bool corresponde a CIF/FOB
        number_format($purchase->valorFrete, 2, ',', '.'),
        number_format($purchase->valorSeguro, 2, ',', '.'),
        number_format($purchase->outrasDespesas, 2, ',', '.'),
        number_format($purchase->totalProdutos, 2, ',', '.'),
        number_format($purchase->totalPagar, 2, ',', '.'),
        $purchase->observacao ?? '-',
        $purchase->supplier->nome ?? '-', // Nome do fornecedor, caso exista
        $purchase->paymentTerm->nome ?? '-', // Nome da condição de pagamento, caso exista
        $purchase->dataCancelamento ? \Carbon\Carbon::parse($purchase->dataCancelamento)->format('d/m/Y H:i') : '-'
      ];
    }

    // Gera o arquivo CSV
    $filename = 'compras-export_' . now()->format('dmY-Hi') . '.csv';
    $handle = fopen('php://temp', 'w');
    foreach ($csvData as $row) {
      fputcsv($handle, $row, ';'); // Usa o delimitador `;`
    }
    rewind($handle);
    $content = stream_get_contents($handle);
    fclose($handle);

    // Retorna a resposta como arquivo para download
    return response($content)
      ->header('Content-Type', 'text/csv')
      ->header('Content-Disposition', "attachment; filename=\"$filename\"");
  }


  public function checkPurchase(Request $request)
  {

    $purchaseData = $request->only([
      'numeroNota',
      'modelo',
      'serie',
      'supplier_id',
    ]);

    try {
      // Verificar se o registro já existe
      $exists = Purchase::where('numeroNota', $purchaseData['numeroNota'])
        ->where('modelo', $purchaseData['modelo'])
        ->where('serie', $purchaseData['serie'])
        ->where('supplier_id', $purchaseData['supplier_id'])
        ->exists();

      // Retornar a resposta
      if ($exists) {
        return response()->json([
          'success' => true,
          'message' => 'Nota fiscal já cadastrada no sistema.',
          'exists' => true
        ], 200); // Código HTTP 409: Conflito
      } else {
        return response()->json([
          'success' => true,
          'message' => 'Nenhum registro encontrado.',
          'exists' => false
        ], 200);
      }
    } catch (QueryException $e) {
      Log::error('Erro ao verificar nota de compra: ' . $e->getMessage());

      return response()->json([
        'success' => false,
        'message' => 'Ops, algo deu errado ao verificar a nota de compra, tente novamente.'
      ], 500); // Código HTTP 500: Erro interno do servidor
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $fornecedores = Supplier::where('ativo', true)->orderBy('id')->get();
    $paymentTerms = PaymentTerm::where('ativo', true)->orderBy('id')->get();
    $products = Product::where('ativo', true)->orderBy('id')->with('measure')->get();
    $suppliers = Supplier::where('ativo', true)->orderBy('id')->get();

    return view('content.purchase.create', compact('fornecedores', 'paymentTerms', 'products', 'suppliers'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PurchaseRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {
        // Dados da compra
        $purchaseData = $request->only([
          'numeroNota',
          'modelo',
          'serie',
          'supplier_id',
          'dataEmissao',
          'dataChegada',
          'tipoFrete',
          'valorFrete',
          'valorSeguro',
          'outrasDespesas',
          'totalProdutos',
          'totalPagar',
          'payment_term_id',
          'observacao'
        ]);

        // Criação da compra
        $purchase = Purchase::create($purchaseData);

        // Agora vamos inserir os produtos da compra na tabela purchase_products
        foreach ($request->products as $productData) {
          // Criação do relacionamento na tabela purchase_products
          PurchaseProducts::create([
            'numeroNota' => $purchase->numeroNota,
            'modelo' => $purchase->modelo,
            'serie' => $purchase->serie,
            'supplier_id' => $purchase->supplier_id,
            'product_id' => $productData['product_id'],
            'precoProduto' => $productData['precoProduto'],
            'qtdProduto' => $productData['qtdProduto'],
            'descontoProduto' => $productData['descontoProduto'] ?? 0,
            'custoMedio' => $productData['custoMedio'],
            'custoUltCompra' => $productData['custoUltCompra'],
            'rateio' => $productData['rateio'] ?? 0,
          ]);
        }
      });

      // Sucesso
      return to_route('purchase.index')->with('success', 'Nota de compra cadastrada com sucesso.');
    } catch (QueryException $e) {
      // Erro
      Log::error('Erro ao cadastrar nota de compra: ' . $e->getMessage());

      return to_route('purchase.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }


  /**
   * Display the specified resource.
   */
  public function show(Purchase $purchase)
  {
    return view('content.purchase.show', compact('purchase'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Purchase $purchase)
  {
    try {
      $purchase = Purchase::with(['fornecedor', 'condicaoPagamento'])->findOrFail($purchase->id);

      $fornecedores = Supplier::where('ativo', true)->get();
      $paymentTerms = PaymentTerm::where('ativo', true)->get();

      return view('content.purchase.edit', compact('purchase', 'fornecedores', 'paymentTerms'));
    } catch (QueryException $e) {
      Log::error('Erro ao carregar nota de compra para edição: ' . $e->getMessage());

      return to_route('purchase.index')
        ->with('failed', 'Ops, algo deu errado ao carregar os dados para edição, tente novamente.');
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PurchaseRequest $request, Purchase $purchase)
  {
    try {
      DB::transaction(function () use ($request, $purchase) {
        $purchaseData = $request->only([
          'numeroNota',
          'modelo',
          'serie',
          'supplier_id',
          'dataEmissao',
          'dataChegada',
          'tipoFrete',
          'valorFrete',
          'valorSeguro',
          'outrasDespesas',
          'totalProdutos',
          'totalPagar',
          'payment_term_id',
          'observacao'
        ]);

        $purchase->update($purchaseData);
      });

      return to_route('purchase.index')->with('success', 'Nota de compra atualizada com sucesso.');
    } catch (QueryException $e) {
      Log::error('Erro ao atualizar nota de compra: ' . $e->getMessage());

      return to_route('purchase.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Cancela a nota de compra.
   */
  public function cancel(Purchase $purchase)
  {
    try {
      DB::transaction(function () use ($purchase) {
        $purchase->update([
          'data_cancelamento' => now()
        ]);
      });

      return to_route('purchase.index')->with('success', 'Nota de compra cancelada com sucesso.');
    } catch (QueryException $e) {
      Log::error('Erro ao cancelar nota de compra: ' . $e->getMessage());

      return to_route('purchase.index')->with('failed', 'Ops, algo deu errado ao cancelar a nota, tente novamente.');
    }
  }



  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Purchase $purchase)
  {
    try {
      if ($purchase->estaCancelada()) {
        $purchase->delete();
        return to_route('purchase.index')->with('success', 'Nota de compra excluída com sucesso.');
      }

      return to_route('purchase.index')
        ->with('failed', 'Não é possível excluir uma nota de compra que não está cancelada.');
    } catch (QueryException $e) {
      Log::error('Erro ao excluir nota de compra: ' . $e->getMessage());

      return to_route('purchase.index')->with('failed', 'Ops, algo deu errado ao excluir a nota, tente novamente.');
    }
  }

  /**
   * Busca notas de compra.
   */
  public function buscar(Request $request)
  {
    $search = $request->input('search') ?? '';
    $purchases = Purchase::where('numeroNota', 'like', "%{$search}%")
      ->orWhereHas('fornecedor', function ($query) use ($search) {
        $query->where('razao_social', 'like', "%{$search}%");
      })
      ->paginate(10);

    return response()->json($purchases);
  }
}
