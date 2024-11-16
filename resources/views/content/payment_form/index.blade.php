@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Formas de Pagamento')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Formas de Pagamento</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary toUpperCase" href="{{ route('payment_form.create') }}">Cadastrar Forma de
                    Pagamento</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Forma de Pagamento</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($paymentForms as $paymentForm)
                            <tr>
                                <td>{{ $paymentForm->id }}</td>
                                <td>{{ $paymentForm->formaPagamento }}</td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('payment_form.edit', $paymentForm->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $paymentForm->id }}">
                                        <span class="tf-icons bx bx-trash bx-22px"></span>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $paymentForm->id,
                                        'objNome' => $paymentForm->formaPagamento,
                                        'action' => 'payment_form.destroy',
                                    ])

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 mt-4">
                {{ $paymentForms->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
