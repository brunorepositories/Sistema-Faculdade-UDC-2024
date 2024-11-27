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

  public function findId($id)
  {
    // Tenta encontrar o cliente pelo ID
    $customer = Customer::find($id);

    // Verifica se o cliente foi encontrado
    if ($customer) {
      return response()->json([
        'success' => true,
        'message' => 'Cliente encontrado.',
        'exists' => true,
        'customer' => $customer
      ], 200);
    }

    // Se não encontrar o cliente, retorna uma mensagem de erro
    return response()->json([
      'success' => false,
      'message' => 'Nenhum registro encontrado.',
      'exists' => false,
      'customer' => null
    ], 404);
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

  public function export()
  {
    $customers = Customer::with(['city', 'paymentTerm'])->get(); // Carrega as relações necessárias

    // Cabeçalhos do CSV correspondentes às colunas da migrate
    $csvData = [];
    $csvData[] = [
      'Código',
      'Tipo de Pessoa',
      'Razão Social',
      'CPF/CNPJ',
      'RG/IE',
      'Endereço',
      'Bairro',
      'Número',
      'CEP',
      'Apelido / Nome Fantasia',
      'Complemento',
      'Sexo',
      'Email',
      'Usuário',
      'Telefone',
      'Celular',
      'Nome do Contato',
      'Data de Nascimento',
      'Ativo',
      'Cidade',
      'Termos de Pagamento'
    ];

    // Adiciona os dados do cliente ao CSV
    foreach ($customers as $customer) {
      $csvData[] = [
        $customer->id,
        $customer->tipoPessoa,
        $customer->clienteRazaoSocial,
        $customer->cpfCnpj,
        $customer->rgIe ?? '-',
        $customer->endereco,
        $customer->bairro,
        $customer->numero,
        $customer->cep,
        $customer->apelidoNomeFantasia ?? '-',
        $customer->complemento ?? '-',
        $customer->sexo ?? '-',
        $customer->email ?? '-',
        $customer->usuario ?? '-',
        $customer->telefone ?? '-',
        $customer->celular,
        $customer->nomeContato ?? '-',
        $customer->dataNasc ? \Carbon\Carbon::parse($customer->dataNasc)->format('d/m/Y') : '-',
        $customer->ativo ? 'Sim' : 'Não',
        $customer->city->nome ?? '-', // Nome da cidade
        $customer->paymentTerm->descricao ?? '-' // Termos de pagamento
      ];
    }

    // Gera o arquivo CSV
    $filename = 'clientes-export_' . now()->format('dmY-Hi') . '.csv';
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
