@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Produtos')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Produtos</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary toUpperCase" href="{{ route('product.create') }}">Cadastrar Produto</a>
            </div>
        </div>

        <div class="card-body">

        @include('components.feedbackMessage')

            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('product.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nome do produto" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('product.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nome do produto"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('product.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control toUpperCase"
                        placeholder="Buscar por nome do produto"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary toUpperCase">Buscar</button>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Medida</th> <!-- Nome da medida associada -->
                            <th>Estoque</th>
                            <th>Preço de Custo</th>
                            <th>Preço de Venda</th>
                            <th>Última Compra</th>
                            <th>Última Venda</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->nome }}</td>
                                <td>{{ $product->measure->nome }} ({{ $product->measure->sigla }}) </td>
                                <!-- Nome da medida associada -->
                                <td>{{ $product->estoque }}</td>
                                <td> R$ {{ number_format($product->precoCusto, 2, ',', '.') }}</td>
                                <!-- Formatação para R$ -->
                                <td> R$ {{ number_format($product->precoVenda, 2, ',', '.') }}</td>
                                <!-- Formatação para R$ -->
                                <td>{{ $product->dtUltimaCompra ? \Carbon\Carbon::parse($product->dtUltimaCompra)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td>{{ $product->dtUltimaVenda ? \Carbon\Carbon::parse($product->dtUltimaVenda)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('product.edit', $product->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $product->id }}">
                                        <i class='bx bx-trash'></i>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $product->id,
                                        'objNome' => $product->nome,
                                        'action' => 'product.destroy',
                                    ])

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
