@extends('layouts/contentNavbarLayout')

@section('title', 'Notas de Venda')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Vendas</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-outline-primary toUpperCase me-4" href="{{ route('sale.export') }}">
                    Exportar relatório
                </a>
                <a class="btn btn-primary toUpperCase" href="{{ route('sale.create') }}">
                    Registrar Venda
                </a>
            </div>
        </div>

        <div class="card-body">
            @include('components.feedbackMessage')

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Nº Nota</th>
                            <th>Modelo</th>
                            <th>Série</th>
                            <th class="text-center">Data Emissão</th>
                            <th class="text-center">Data Saída</th>
                            <th>Valor da Nota</th>
                            <th>Status</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->customer->id }} - {{ $sale->customer->nome }}</td>
                                <td>{{ $sale->numeroNota }}</td>
                                <td>{{ $sale->modelo }}</td>
                                <td>{{ $sale->serie }}</td>
                                <td class="text-center">{{ $sale->dataEmissao->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $sale->dataSaida->format('d/m/Y') }}</td>
                                <td class="text-end">R$ {{ number_format($sale->totalPagar, 2, ',', '.') }}</td>
                                <td>
                                    @if ($sale->dataCancelamento)
                                        <span class="badge bg-label-danger">Cancelada</span>
                                    @else
                                        @php
                                            $statusPagamento = 'pendente';
                                            $badgeColor = 'warning';
                                            $recebido = $sale->accountReceivables
                                                ->where('status', 'pago')
                                                ->sum('valorPago');
                                            $total = $sale->totalPagar;

                                            if ($recebido >= $total) {
                                                $statusPagamento = 'pago';
                                                $badgeColor = 'success';
                                            } elseif ($recebido > 0) {
                                                $statusPagamento = 'parcial';
                                                $badgeColor = 'info';
                                            }
                                        @endphp
                                        <span class="badge bg-label-{{ $badgeColor }}">
                                            {{ ucfirst($statusPagamento) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('sale.show', [
                                            'numeroNota' => $sale->numeroNota,
                                            'modelo' => $sale->modelo,
                                            'serie' => $sale->serie,
                                            'customer_id' => $sale->customer_id,
                                        ]) }}">
                                        <span class="bx bx-detail bx-tada-hover bx-22px"></span>
                                    </a>

                                    @if (!$sale->dataCancelamento)
                                        <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                            data-bs-toggle="modal" data-bs-target="#cancelModal{{ $sale->id }}">
                                            <span class="bx bx-block bx-tada-hover bx-22px"></span>
                                        </button>

                                        <!-- Modal de Cancelamento -->
                                        <div class="modal fade" id="cancelModal{{ $sale->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('sale.cancel', $sale->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Cancelar Venda</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Deseja realmente cancelar esta venda?</p>
                                                            <p>Esta ação irá:</p>
                                                            <ul>
                                                                <li>Devolver os produtos ao estoque</li>
                                                                <li>Cancelar as parcelas pendentes</li>
                                                                <li>Marcar a venda como cancelada</li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary toUpperCase me-4"
                                                                data-bs-dismiss="modal">Fechar</button>
                                                            <button type="submit"
                                                                class="btn btn-danger toUpperCase">Confirmar
                                                                Cancelamento</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-4">
                {{ $sales->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
