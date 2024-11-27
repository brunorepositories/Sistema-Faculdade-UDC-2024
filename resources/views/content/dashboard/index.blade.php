@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')

    {{-- Resto do conteúdo permanece igual --}}
    <div class="row">
        {{-- Cards Principais --}}
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mb-0">Resumo do Mês</h4>

                    <div>
                        <form method="GET" action="{{ route('dashboard.index') }}" class="d-flex align-items-center">
                            <div class="">
                                <input
                                    type="month"
                                    class="form-control"
                                    id="mes"
                                    name="mes"
                                    value="{{ request('mes', date('Y-m')) }}"
                                    max="{{ date('Y-m') }}">
                            </div>
                            <div class="ms-4">
                                <button type="submit" class="btn btn-primary d-block toUpperCase">Atualizar</button>
                            </div>
                        </form>
                    </div>


                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$ {{ number_format($vendasMes->valor_total, 2, ',', '.') }}</h4>
                                    <small>Total em Vendas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">{{ $vendasMes->total_vendas }}</h4>
                                    <small>Vendas Realizadas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$ {{ number_format($comprasMes->valor_total, 2, ',', '.') }}
                                    </h4>
                                    <small>Total em Compras</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">{{ $comprasMes->total_compras }}</h4>
                                    <small>Compras Realizadas</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Financeiro Recebimentos --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recebimentos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$
                                        {{ number_format($financeiroReceber['recebido'], 2, ',', '.') }}
                                    </h4>
                                    <small>Recebido</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$
                                        {{ number_format($financeiroReceber['a_receber'], 2, ',', '.') }}
                                    </h4>
                                    <small>A Receber</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$
                                        {{ number_format($financeiroReceber['vencido'], 2, ',', '.') }}
                                    </h4>
                                    <small>Vencido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Financeiro Pagamentos --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pagamentos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$ {{ number_format($financeiroPagar['pago'], 2, ',', '.') }}
                                    </h4>
                                    <small>Pago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$ {{ number_format($financeiroPagar['a_pagar'], 2, ',', '.') }}
                                    </h4>
                                    <small>A Pagar</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="card-info">
                                    <h4 class="mb-0">R$ {{ number_format($financeiroPagar['vencido'], 2, ',', '.') }}
                                    </h4>
                                    <small>Vencido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Produtos Vendidos --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Top 10 Produtos Vendidos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th class="text-end">Qtd</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topProdutos as $produto)
                                    <tr>
                                        <td>{{ $produto->nome }}</td>
                                        <td class="text-end">{{ $produto->quantidade_vendida }}</td>
                                        <td class="text-end">R$ {{ number_format($produto->valor_total, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Produtos Comprados --}}
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Top 10 Produtos Comprados</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th class="text-end">Qtd</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topProdutosComprados as $produto)
                                    <tr>
                                        <td>{{ $produto->nome }}</td>
                                        <td class="text-end">{{ $produto->quantidade_comprada }}</td>
                                        <td class="text-end">R$
                                            {{ number_format($produto->valor_total, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
