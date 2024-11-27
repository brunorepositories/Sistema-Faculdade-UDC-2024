@extends('layouts/contentNavbarLayout')

@section('title', 'Contas a Pagar')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Contas a Pagar</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-outline-primary toUpperCase me-4" href="{{ route('account_payable.index') }}">
                    Exportar relatório
                </a>
            </div>
        </div>

        <div class="card-body">
            @include('components.feedbackMessage')

            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('account_payable.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control toUpperCase"
                                placeholder="Buscar por Nº Nota"
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="status" class="form-select">
                                <option value="">Todos os Status</option>
                                <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente
                                </option>
                                <option value="pago" {{ request('status') == 'pago' ? 'selected' : '' }}>Pago</option>
                                <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>Cancelado
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" name="data_inicio" class="form-control"
                                value="{{ request('data_inicio') }}" placeholder="Data Início">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" name="data_fim" class="form-control"
                                value="{{ request('data_fim') }}" placeholder="Data Fim">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary toUpperCase w-100">Buscar</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fornecedor</th>
                            <th>Parcela</th>
                            <th>Valor Parcela</th>
                            <th class="text-center">Vencimento</th>
                            <th>Data Pagamento</th>
                            <th>Forma Pagamento</th>
                            <th class="text-center">Status</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($accountPayables as $accountPayable)
                            <tr>
                                <td>{{ $accountPayable->supplier->id }} -
                                    {{ $accountPayable->supplier->fornecedorRazaoSocial }}</td>
                                <td class="text-center">{{ $accountPayable->parcela }}</td>
                                </td>
                                <td class="text-end">R$ {{ number_format($accountPayable->valorParcela, 2, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($accountPayable->dataVencimento)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    {{ $accountPayable->dataPagamento ? \Carbon\Carbon::parse($accountPayable->dataPagamento)->format('d/m/Y') : '-' }}
                                </td>
                                <td>{{ $accountPayable->paymentForm->formaPagamento }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge rounded-pill bg-{{ $accountPayable->status == 'pendente' ? 'warning' : ($accountPayable->status == 'pago' ? 'success' : 'danger') }}">
                                        {{ ucfirst($accountPayable->status) }}
                                    </span>
                                </td class="text-center">

                                {{-- Botões da listagem --}}
                                <td class="size-col-action">
                                    @if ($accountPayable->status == 'pendente')
                                        <button type="button"
                                            class="btn btn-outline-success rounded-pill border-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#paymentModal{{ $accountPayable->id }}">
                                            <i class='bx bx-dollar-circle bx-tada-hover bx-22px'></i>
                                        </button>
                                    @endif



                                    @if ($accountPayable->status == 'pendente')
                                        <button type="button"
                                            class="btn btn-outline-danger rounded-pill border-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#cancelModal{{ $accountPayable->id }}">
                                            <i class='bx bx-x-circle bx-tada-hover bx-22px'></i>
                                        </button>
                                    @endif

                                    {{-- <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('account_payable.index', $accountPayable->id) }}">
                                        <span class="tf-icons bx bx-edit bx-tada-hover bx-22px bx-22px"></span>
                                    </a> --}}
                                </td>
                            </tr>

                            <!-- Modal de Pagamento -->
                            <div class="modal fade" id="paymentModal{{ $accountPayable->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <form action="{{ route('account_payable.pay', $accountPayable->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Registrar Pagamento</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Valor a Pagar</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            name="valorPago"
                                                            value="{{ $accountPayable->valorParcela }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Data Pagamento</label>
                                                        <input type="date" class="form-control" name="dataPagamento"
                                                            value="{{ date('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Juros</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            name="juros"
                                                            value="0">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Multa</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            name="multa"
                                                            value="0">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Desconto</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            name="desconto"
                                                            value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary toUpperCase"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success toUpperCase ms-4">Confirmar
                                                    Pagamento</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de Cancelamento -->
                            <div class="modal fade" id="cancelModal{{ $accountPayable->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('account_payable.cancel', $accountPayable->id) }}"
                                            method="POST">
                                            @csrf

                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cancelar Conta a Pagar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Deseja realmente cancelar esta conta a pagar?</p>
                                                <div class="mb-3">
                                                    <label class="form-label">Data Cancelamento</label>
                                                    <input type="date" class="form-control" name="dataCancelamento"
                                                        value="{{ date('Y-m-d') }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary toUpperCase"
                                                    data-bs-dismiss="modal" style="width: 100px">Não</button>
                                                <button type="submit" class="btn btn-danger toUpperCase ms-4">Sim,
                                                    Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-4">
                {{ $accountPayables->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
