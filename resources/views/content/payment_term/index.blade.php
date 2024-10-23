@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Condições de Pagamento')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Condições de Pagamento</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary" href="{{ route('payment_term.create') }}">Cadastrar Condição de Pagamento</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Condição de Pagamento</th>
                            <th>Multa</th>
                            <th>Juro</th>
                            <th>Desconto</th>
                            <th>Quantidade de Parcelas</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($paymentTerms as $paymentTerm)
                            <tr>
                                <td>{{ $paymentTerm->id }}</td>
                                <td>{{ $paymentTerm->condicaoPagamento }}</td>
                                <td>{{ $paymentTerm->multa }}</td>
                                <td>{{ $paymentTerm->juro }}</td>
                                <td>{{ $paymentTerm->desconto }}</td>
                                <td>{{ $paymentTerm->qtdParcelas }}</td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('payment_term.edit', $paymentTerm->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $paymentTerm->id }}">
                                        <span class="tf-icons bx bx-trash bx-22px"></span>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $paymentTerm->id,
                                        'objNome' => $paymentTerm->condicaoPagamento,
                                        'action' => 'payment_term.destroy',
                                    ])

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
