@extends('layouts/contentNavbarLayout')

@section('title', 'Visualizar Nota de Compra')

@section('content')
    <div>
        {{-- Etapa 1: Informações Básicas --}}
        <div class="card mb-8">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Nota Fiscal de Compra #{{ str_pad($purchase->numeroNota, 10, '0', STR_PAD_LEFT) }}
                    </h4>
                    <span
                        class="badge bg-label-{{ $statusPagamento['classe'] }} mt-2">{{ $statusPagamento['status'] }}</span>
                </div>

                <a href="{{ route('purchase.index') }}" class="btn btn-outline-secondary toUpperCase">
                    <i class='bx bx-arrow-back'></i> Voltar
                </a>
            </div>
            <div class="card-body mt-1">
                <h5 class="mb-4">Dados da Nota Fiscal</h5>
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label fw-bold toUpperCase">Número</label>
                        <p class="form-control-static">{{ str_pad($purchase->numeroNota, 10, '0', STR_PAD_LEFT) }}</p>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label fw-bold toUpperCase">Modelo</label>
                        <p class="form-control-static">{{ str_pad($purchase->modelo, 2, '0', STR_PAD_LEFT) }}</p>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label fw-bold toUpperCase">Série</label>
                        <p class="form-control-static">{{ str_pad($purchase->serie, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold toUpperCase">Fornecedor</label>
                        <p class="form-control-static">
                            {{ $purchase->supplier->id }} - {{ $purchase->supplier->fornecedorRazaoSocial }}
                        </p>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold toUpperCase">Data Emissão</label>
                        <p class="form-control-static">{{ \Carbon\Carbon::parse($purchase->dataEmissao)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold toUpperCase">Data Chegada</label>
                        <p class="form-control-static">{{ \Carbon\Carbon::parse($purchase->dataChegada)->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="mb-2">Dados do fornecedor</h6>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex">
                            <p class="mb-0">Telefone: {{ $fornecedorDetalhes['telefone'] }}</p>
                            <p class="mb-0 ms-4">E-mail: {{ $purchase->supplier->email }}</p>
                            <p class="mb-0 ms-4">
                                {{ $fornecedorDetalhes['documento'] }}: {{ $fornecedorDetalhes['numeroDocumento'] }}
                            </p>
                        </div>
                        <p class="mb-0">Endereço: {{ $fornecedorDetalhes['endereco'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Etapa 2: Produtos --}}
        <div class="card mb-8">
            <div class="card-header">
                <h5 class="mb-0">Produtos</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Produto</th>
                                <th>Unidade</th>
                                <th>Quantidade</th>
                                <th>Preço Unitário</th>
                                <th>Desconto</th>
                                <th>Preço total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->nome }}</td>
                                    <td>{{ $product->measure->sigla }}</td>
                                    <td>{{ $product->pivot->qtdProduto }}</td>
                                    <td>{{ 'R$ ' . number_format($product->pivot->precoProduto, 2, ',', '.') }}</td>
                                    <td>{{ $product->pivot->descontoProduto }}%</td>
                                    <td>{{ 'R$ ' . number_format($product->pivot->precoTotal, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Totais:</td>
                                <td>{{ $totals['totalQuantidade'] }}</td>
                                <td>-</td>
                                <td>{{ 'R$ ' . number_format($totals['totalDesconto'], 2, ',', '.') }}</td>
                                <td>{{ 'R$ ' . number_format($totals['totalProdutosSemDesconto'], 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-start mt-4">
                    {{-- Seção Frete --}}
                    <div>
                        <h5>Frete</h5>
                        <div class="d-flex gap-4">
                            <div>
                                <label class="form-label fw-bold toUpperCase">Tipo Frete</label>
                                <p class="form-control-static">{{ $purchase->tipoFrete }}</p>
                            </div>
                            <div>
                                <label class="form-label fw-bold toUpperCase">Valor Frete</label>
                                <p class="form-control-static">
                                    {{ 'R$ ' . number_format($purchase->valorFrete, 2, ',', '.') }}</p>
                            </div>
                            <div>
                                <label class="form-label fw-bold toUpperCase">Valor Seguro</label>
                                <p class="form-control-static">
                                    {{ 'R$ ' . number_format($purchase->valorSeguro, 2, ',', '.') }}</p>
                            </div>
                            <div>
                                <label class="form-label fw-bold toUpperCase">Outras despesas</label>
                                <p class="form-control-static">
                                    {{ 'R$ ' . number_format($purchase->outrasDespesas, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Seção Totais --}}
                    <div>
                        <h5>Totais</h5>
                        <div class="d-flex gap-4">
                            <div>
                                <label class="form-label fw-bold toUpperCase">QTD. produtos</label>
                                <p class="form-control-static">{{ $totals['totalQuantidade'] }}</p>
                            </div>
                            <div>
                                <label class="form-label fw-bold toUpperCase">Valor produtos</label>
                                <p class="form-control-static">
                                    {{ 'R$ ' . number_format($purchase->totalProdutos, 2, ',', '.') }}</p>
                            </div>
                            <div>
                                <label class="form-label fw-bold toUpperCase">Valor da nota</label>
                                <p class="form-control-static">
                                    {{ 'R$ ' . number_format($purchase->totalPagar, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Etapa 3: Parcelas --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Condição de Pagamento</h5>
                <div class="text-end">
                    <p class="mb-0 text-muted">Status do Pagamento: <span
                            class="fw-bold text-{{ $statusPagamento['classe'] }}">{{ $statusPagamento['descricao'] }}</span>
                    </p>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold toUpperCase">Condição de Pagamento</label>
                        <p class="form-control-static">
                            {{ $purchase->paymentTerm->id }} - {{ $purchase->paymentTerm->condicaoPagamento }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end gap-3">
                            <div class="text-center">
                                <small class="text-muted d-block">Total de Parcelas</small>
                                <span class="fw-bold">{{ $statusParcelas['total'] }}</span>
                            </div>
                            <div class="text-center">
                                <small class="text-muted d-block">Parcelas Pagas</small>
                                <span class="fw-bold text-success">{{ $statusParcelas['pagas'] }}</span>
                            </div>
                            <div class="text-center">
                                <small class="text-muted d-block">Parcelas Pendentes</small>
                                <span class="fw-bold text-warning">{{ $statusParcelas['pendentes'] }}</span>
                            </div>
                            <div class="text-center">
                                <small class="text-muted d-block">Parcelas Vencidas</small>
                                <span class="fw-bold text-danger">{{ $statusParcelas['vencidas'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nº Parcela</th>
                                <th>Forma de pagamento</th>
                                <th>Data de Vencimento</th>
                                <th>Valor</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->accountPayables as $parcela)
                                <tr>
                                    <td>{{ $parcela->parcela }}ª Parcela</td>
                                    <td>{{ $parcela->paymentForm->formaPagamento }}</td>
                                    <td>{{ \Carbon\Carbon::parse($parcela->dataVencimento)->format('d/m/Y') }}</td>
                                    <td>{{ 'R$ ' . number_format($parcela->valorParcela, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($parcela->status === 'Pendente')
                                            <span class="badge bg-label-warning">Pendente</span>
                                        @elseif($parcela->status === 'Pago')
                                            <span class="badge bg-label-success">Pago</span>
                                        @else
                                            <span class="badge bg-label-danger">Atrasado</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total Pago:</td>
                                <td colspan="2">{{ 'R$ ' . number_format($statusParcelas['totalPago'], 2, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total Restante:</td>
                                <td colspan="2">
                                    {{ 'R$ ' . number_format($statusParcelas['totalRestante'], 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
