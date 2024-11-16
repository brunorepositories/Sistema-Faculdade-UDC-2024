<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\City;
use App\Models\PaymentTerm;
use App\Models\Customer; // Substitua pelo seu modelo de cliente
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = Customer::query();

    if ($search = $request->input('search')) {
      $query->where('clienteRazaoSocial', 'LIKE', '%' . strtoupper($search) . '%');
    }

    $customers = $query->orderBy('updated_at', 'desc')->paginate(10);

    return view('content.customer.index', compact('customers'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(City $cities, PaymentTerm $paymentTerms)
  {
    $cities = City::where('ativo', true)
      ->orderBy('id')
      ->get();
    $paymentTerms = PaymentTerm::where('ativo', true)
      ->orderBy('id')
      ->get();

    return view('content.customer.create', compact('cities', 'paymentTerms'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CustomerRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {
        $customerData = $request->only([
          'tipoPessoa',
          'clienteRazaoSocial',
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

        // // Converte os campos de string para uppercase, se necessário
        // $customerData = array_map('strtoupper', $customerData);

        Customer::create($customerData);
      });

      return to_route('customer.index')->with('success', "Cliente cadastrado com sucesso.");
    } catch (QueryException $th) {
      Log::error('Erro ao cadastrar cliente: ' . $th->getMessage());
      return to_route('customer.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Customer $customer)
  {
    return view('content.customer.show', compact('customer'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Customer $customer)
  {
    $cities = City::where('ativo', true)
      ->orderBy('id')
      ->get();
    $paymentTerms = PaymentTerm::where('ativo', true)
      ->orderBy('id')
      ->get();

    // dd($customer);

    return view('content.customer.edit', compact('customer', 'cities', 'paymentTerms'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CustomerRequest $request, Customer $customer)
  {
    try {
      // dd($request->all());
      $customer->update($request->only([
        'tipoPessoa',
        'clienteRazaoSocial',
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

      return to_route('customer.index')->with('success', 'Cliente atualizado com sucesso.');
    } catch (QueryException $th) {
      Log::error('Erro ao atualizar cliente: ' . $th->getMessage());
      return to_route('customer.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Customer $customer)
  {
    try {
      $customer->delete();
      return to_route('customer.index')->with('success', 'Cliente excluído com sucesso.');
    } catch (QueryException $th) {
      Log::error('Erro ao excluir cliente: ' . $th->getMessage());
      return to_route('customer.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  public function buscar(Request $request)
  {
    $searchTerm = $request->input('search') ?? '';
    $customers = Customer::where('clienteRazaoSocial', 'LIKE', "%{$searchTerm}%")
      ->orWhere('apelidoNomeFantasia', 'LIKE', "%{$searchTerm}%")
      ->paginate(10);

    return response()->json($customers);
  }
}
