<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\City;
use App\Models\PaymentTerm;
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

        // Converte os campos de string para uppercase, se necessário
        $supplierData = array_map('strtoupper', $supplierData);

        Supplier::create($supplierData);
      });

      return to_route('supplier.index')->with('success', "Fornecedor cadastrado com sucesso.");
    } catch (QueryException $th) {
      Log::error('Erro ao cadastrar fornecedor: ' . $th->getMessage());
      return to_route('supplier.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Supplier $supplier)
  {
    return view('content.supplier.show', compact('supplier'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Supplier $supplier)
  {
    return view('content.supplier.edit', compact('supplier'));
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
