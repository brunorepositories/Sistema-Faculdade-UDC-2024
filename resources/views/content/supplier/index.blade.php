@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Fornecedores')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Fornecedores</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-outline-primary toUpperCase me-4" href="{{ route('supplier.export') }}">Exportar
                    relatório</a>
                <a class="btn btn-primary toUpperCase" href="{{ route('supplier.create') }}">Cadastrar Fornecedor</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('supplier.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control toUpperCase"
                        placeholder="Buscar por nome do fornecedor"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary toUpperCase">Buscar</button>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fornecedor</th>
                            <th>Documento</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Ativo</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->fornecedorRazaoSocial }}</td>
                                <td>{{ $supplier->cpfCnpj }}</td>
                                <td>{{ $supplier->celular }}</td>
                                <td>{{ $supplier->email }}</td>
                                <!-- Alteração para exibir o checkbox -->
                                <td>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="ativo"
                                            id="ativo_{{ $supplier->id }}"
                                            value="1"
                                            disabled
                                            {{ $supplier->ativo ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ativo_{{ $supplier->id }}">
                                        </label>
                                    </div>
                                </td>
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
            <div class="col-12 mt-4">
                {{ $suppliers->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
