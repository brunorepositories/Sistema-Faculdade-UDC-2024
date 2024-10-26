@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Fornecedores')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Fornecedores</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary" href="{{ route('supplier.create') }}">Cadastrar Fornecedor</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fornecedor</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ativo</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->fornecedorRazaoSocial }}</td>
                                @if ($supplier->tipoPessoa == 'F')
                                    <td>{{ $supplier->cpf }}</td>
                                @else
                                    <td>{{ $supplier->cnpj }}</td>
                                @endif
                                <td>{{ $supplier->apelidoNomeFantasia }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->telefone }}</td>
                                <td>{{ $supplier->ativo ? 'Sim' : 'Não' }}</td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('supplier.edit', $supplier->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $supplier->id }}">
                                        <span class="tf-icons bx bx-trash bx-22px"></span>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $supplier->id,
                                        'objNome' => $supplier->fornecedorRazaoSocial,
                                        'action' => 'supplier.destroy',
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
