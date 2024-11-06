@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Produto')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Editar Produto</h4>

        <div class="card-body">
            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('product.update', $product->id) }}"
                method="POST"
                novalidate="">

                @csrf
                @method('PUT') <!-- Usando PUT para a edição -->

                <div class="col-7">
                    <label class="form-label" for="nome">Nome do Produto</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control"
                        id="nome"
                        placeholder="Informe o nome do produto"
                        maxlength="50"
                        value="{{ old('nome', $product->nome) }}"> <!-- Preenchendo com o valor atual -->
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label" for="estoque">Estoque</label>
                    <input
                        required
                        name="estoque"
                        type="number"
                        class="form-control"
                        id="estoque"
                        placeholder="Informe o estoque"
                        value="{{ old('estoque', $product->estoque) }}"> <!-- Preenchendo com o valor atual -->
                    @error('estoque')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3">
                    <label class="form-label" for="measure_id">Medida</label>
                    <div class="input-group">
                        <select
                            required
                            name="measure_id"
                            class="form-select"
                            id="measure_id">
                            <option value="" disabled>Selecione</option>
                            @foreach ($measures as $measure)
                                <option value="{{ $measure->id }}"
                                    {{ $measure->id == $product->measure_id ? 'selected' : '' }}>
                                    {{ $measure->nome }}
                                </option>
                            @endforeach
                        </select>

                        <button class="btn btn-outline-secondary"
                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#measureModal">
                            <span class="tf-icons bx bx-search bx-18px"></span>
                        </button>
                    </div>
                    @error('measure_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Preço de Custo -->
                <div class="col-3 mt-4">
                    <label class="form-label" for="precoCusto">Preço de Custo</label>
                    <input
                        required
                        name="precoCusto"
                        type="text"
                        class="form-control preco"
                        id="precoCusto"
                        placeholder="R$ 0,00"
                        value="{{ old('precoCusto', 'R$ ' . number_format($product->precoCusto, 2, ',', '.')) }}">
                    @error('precoCusto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Preço de Venda -->
                <div class="col-3 mt-4">
                    <label class="form-label" for="precoVenda">Preço de Venda</label>
                    <input
                        required
                        name="precoVenda"
                        type="text"
                        class="form-control preco"
                        id="precoVenda"
                        placeholder="R$ 0,00"
                        value="{{ old('precoVenda', 'R$ ' . number_format($product->precoVenda, 2, ',', '.')) }}">
                    @error('precoVenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Custo da Última Compra -->
                <div class="col-3 mt-4">
                    <label class="form-label" for="custoUltimaCompra">Custo da Última Compra</label>
                    <input
                        name="custoUltimaCompra"
                        type="text"
                        class="form-control preco"
                        id="custoUltimaCompra"
                        placeholder="R$ 0,00"
                        value="{{ old('custoUltimaCompra', 'R$ ' . number_format($product->custoUltimaCompra, 2, ',', '.')) }}">
                    @error('custoUltimaCompra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Custo da Última Venda -->
                <div class="col-3 mt-4">
                    <label class="form-label" for="custoUltimaVenda">Custo da Última Venda</label>
                    <input
                        name="custoUltimaVenda"
                        type="text"
                        class="form-control preco"
                        id="custoUltimaVenda"
                        placeholder="R$ 0,00"
                        value="{{ old('custoUltimaVenda', 'R$ ' . number_format($product->custoUltimaVenda, 2, ',', '.')) }}">
                    @error('custoUltimaVenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Data da Última Compra -->
                <div class="col-6 mt-4">
                    <label class="form-label" for="dtUltimaCompra">Data da Última Compra</label>
                    <input
                        name="dtUltimaCompra"
                        type="datetime-local"
                        class="form-control"
                        id="dtUltimaCompra"
                        value="{{ old('dtUltimaCompra', $product->dtUltimaCompra ? \Carbon\Carbon::parse($product->dtUltimaCompra)->format('Y-m-d\TH:i') : '') }}">
                    @error('dtUltimaCompra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Data da Última Venda -->
                <div class="col-6 mt-4">
                    <label class="form-label" for="dtUltimaVenda">Data da Última Venda</label>
                    <input
                        name="dtUltimaVenda"
                        type="datetime-local"
                        class="form-control"
                        id="dtUltimaVenda"
                        value="{{ old('dtUltimaVenda', $product->dtUltimaVenda ? \Carbon\Carbon::parse($product->dtUltimaVenda)->format('Y-m-d\TH:i') : '') }}">
                    @error('dtUltimaVenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-10">
                    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary me-4">Cancelar</a>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Selecionar Medida -->
    @include('content.product.modal.selectMeasure')


<script>
    document.querySelectorAll('.preco').forEach(function (input) {
        input.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');  // Remove qualquer coisa que não seja número
            value = (value / 100).toFixed(2).replace('.', ','); // Converte para valor com 2 casas decimais
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Adiciona o separador de milhar
            e.target.value = 'R$ ' + value;  // Formata o valor
        });
    });
</script>

@endsection
