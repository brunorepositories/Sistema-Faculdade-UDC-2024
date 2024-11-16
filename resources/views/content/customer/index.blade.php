@extends('layouts/contentNavbarLayout')

@section('title', 'Clientes')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Clientes</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary toUpperCase" href="{{ route('customer.create') }}">Cadastrar Cliente</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('customer.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control toUpperCase"
                        placeholder="Buscar por nome do cliente"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary toUpperCase">Buscar</button>
                </div>
            </form>


            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ativo</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->clienteRazaoSocial }}</td>
                                @if ($customer->tipoPessoa == 'F')
                                    <td>{{ $customer->cpf }}</td>
                                @else
                                    <td>{{ $customer->cnpj }}</td>
                                @endif
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->telefone }}</td>
                                <td>{{ $customer->ativo ? 'Sim' : 'Não' }}</td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('customer.edit', $customer->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $customer->id }}">
                                        <span class="tf-icons bx bx-trash bx-22px"></span>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $customer->id,
                                        'objNome' => $customer->clienteRazaoSocial,
                                        'action' => 'customer.destroy',
                                    ])

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-4">
                {{ $customers->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
@endsection
