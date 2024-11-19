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
    $suppliers = Supplier::with(['city', 'paymentTerm'])->get(); // Carrega as relações necessárias

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

    // Adiciona os dados do fornecedor ao CSV
    foreach ($suppliers as $supplier) {
      $csvData[] = [
        $supplier->id,
        $supplier->tipoPessoa,
        $supplier->fornecedorRazaoSocial,
        $supplier->cpfCnpj,
        $supplier->rgIe ?? '-',
        $supplier->endereco,
        $supplier->bairro,
        $supplier->numero,
        $supplier->cep,
        $supplier->apelidoNomeFantasia ?? '-',
        $supplier->complemento ?? '-',
        $supplier->sexo ?? '-',
        $supplier->email ?? '-',
        $supplier->usuario ?? '-',
        $supplier->telefone ?? '-',
        $supplier->celular,
        $supplier->nomeContato ?? '-',
        $supplier->dataNasc ? \Carbon\Carbon::parse($supplier->dataNasc)->format('d/m/Y') : '-',
        $supplier->ativo ? 'Sim' : 'Não',
        $supplier->city->nome ?? '-', // Nome da cidade
        $supplier->paymentTerm->descricao ?? '-' // Termos de pagamento
      ];
    }

    // Gera o arquivo CSV
    $filename = 'fornecedores-export_' . now()->format('dmY-Hi') . '.csv';
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
