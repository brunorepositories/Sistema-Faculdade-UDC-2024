<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PaymentTerm;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $fornecedores = Supplier::where('ativo', true)->orderBy('id')->get();
    $paymentTerms = PaymentTerm::where('ativo', true)->orderBy('id')->get();
    $products = Product::where('ativo', true)->orderBy('id')->get();

    return view('content.purchase.create', compact('fornecedores', 'paymentTerms', 'products'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PurchaseRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {
        $purchaseData = $request->only([
          'numero_nota',
          'modelo',
          'serie',
          'supplier_id',
          'data_emissao',
          'data_chegada',
          'tipo_frete',
          'valor_frete',
          'valor_seguro',
          'outras_despesas',
          'total_produtos',
          'total_pagar',
          'payment_term_id',
          'observacao'
        ]);

        Purchase::create($purchaseData);
      });

      return to_route('purchase.index')->with('success', 'Nota de compra cadastrada com sucesso.');
    } catch (QueryException $e) {
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
          'numero_nota',
          'modelo',
          'serie',
          'supplier_id',
          'data_emissao',
          'data_chegada',
          'tipo_frete',
          'valor_frete',
          'valor_seguro',
          'outras_despesas',
          'total_produtos',
          'total_pagar',
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
    $purchases = Purchase::where('numero_nota', 'like', "%{$search}%")
      ->orWhereHas('fornecedor', function ($query) use ($search) {
        $query->where('razao_social', 'like', "%{$search}%");
      })
      ->paginate(10);

    return response()->json($purchases);
  }
}
