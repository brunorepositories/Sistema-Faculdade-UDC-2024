@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Produtos')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Produtos</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-outline-primary toUpperCase me-4" href="{{ route('product.export') }}">Exportar
                    relatório</a>
                <a class="btn btn-primary toUpperCase" href="{{ route('product.create') }}">Cadastrar Produto</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('product.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control toUpperCase"
                        placeholder="Buscar por nome do produto"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary toUpperCase">Buscar</button>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            {{-- <th>Medida</th>  --}}
                            <th class="text-center">Estoque</th>
                            <th>Preço de Venda</th>
                            <th>Preço de Custo</th>
                            <th class="text-center">Última Venda</th>
                            <th class="text-center">Última Compra</th>
                            <th>Ativo</th>
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->nome }}</td>
                                {{-- <td>{{ $product->measure->nome }} {{ $product->measure->sigla }}) </td> --}}

                                <td class="text-center">{{ $product->estoque }}</td>
                                <!-- Formatação para R$ -->
                                <td class="text-end"> R$ {{ number_format($product->precoVenda, 2, ',', '.') }}</td>
                                <td class="text-end"> R$ {{ number_format($product->precoCusto, 2, ',', '.') }}</td>
                                <td class="text-center">
                                    {{ $product->dtUltimaVenda ? \Carbon\Carbon::parse($product->dtUltimaVenda)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <!-- Formatação para R$ -->
                                <td class="text-center">
                                    {{ $product->dtUltimaCompra ? \Carbon\Carbon::parse($product->dtUltimaCompra)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <!-- Alteração para exibir o checkbox -->
                                <td>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="ativo"
                                            id="ativo_{{ $product->id }}"
                                            value="1"
                                            disabled
                                            {{ $product->ativo ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ativo_{{ $product->id }}">
                                        </label>
                                    </div>
                                </td>
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('product.edit', $product->id) }}">
                                        <span class="bx bx-edit bx-22px bx-tada-hover"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $product->id }}">
                                        <i class='bx bx-trash bx-22px bx-tada-hover'></i>
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
            <div class="col-12 mt-4">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
