@extends('layouts/contentNavbarLayout')

@section('title', 'Notas de Compra')

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Compras</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-outline-primary toUpperCase me-4" href="{{ route('purchase.export') }}">Exportar
                    relatório</a>
                <a class="btn btn-primary toUpperCase" href="{{ route('purchase.create') }}">Registrar Compra</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fornecedor</th>
                            <th>Nº Nota</th>
                            <th>Modelo</th>
                            <th>Série</th>
                            <th class="text-center"> Data Emissão</th>
                            <th class="text-center">Data Chegada</th>
                            <th>Valor da Nota</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->supplier->id }} - {{ $purchase->supplier->fornecedorRazaoSocial }}</td>
                                <td>{{ $purchase->numeroNota }}</td>
                                <td>{{ $purchase->modelo }}</td>
                                <td>{{ $purchase->serie }}</td>
                                <!-- Assumindo que 'supplier' é o relacionamento com o fornecedor -->
                                <td class="text-center">{{ $purchase->dataEmissao->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $purchase->dataChegada->format('d/m/Y') }}</td>
                                <td class="text-end">R$ {{ number_format($purchase->totalPagar, 2, ',', '.') }}</td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('purchase.show', [
                                            'numeroNota' => $purchase->numeroNota,
                                            'modelo' => $purchase->modelo,
                                            'serie' => $purchase->serie,
                                            'supplier_id' => $purchase->supplier_id,
                                        ]) }}">
                                        <span class="bx bx-detail bx-tada-hover bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $purchase->id }}">
                                        <span class="bx bx-block bx-tada-hover bx-22px"></span>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $purchase->id,
                                        'objNome' => $purchase->numeroNota,
                                        'action' => 'purchase.destroy',
                                    ])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-4">
                {{ $purchases->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
