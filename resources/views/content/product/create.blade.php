@extends('layouts/contentNavbarLayout')

@section('title', 'Novo Produto')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Novo Produto</h4>

        <div class="card-body">
            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('product.store') }}"
                method="POST"
                novalidate="">

                @csrf

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
                        value="{{ old('nome') }}">
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
                        value="{{ old('estoque') }}">
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
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($measures as $measure)
                                <option value="{{ $measure->id }}">
                                    {{ $measure->nome }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Botão que abre o modal de selecionar medida --}}
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


                <div class="col-3 mt-4">
                    <label class="form-label" for="precoCusto">Preço de Custo</label>
                    <input
                        required
                        name="precoCusto"
                        type="text"
                        class="form-control preco"
                        id="precoCusto"
                        placeholder="R$ 0,00"
                        value="{{ old('precoCusto') }}">
                    @error('precoCusto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3 mt-4">
                    <label class="form-label" for="precoVenda">Preço de Venda</label>
                    <input
                        required
                        name="precoVenda"
                        type="text"
                        class="form-control preco"
                        id="precoVenda"
                        placeholder="R$ 0,00"
                        value="{{ old('precoVenda') }}">
                    @error('precoVenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3 mt-4">
                    <label class="form-label" for="custoUltimaCompra">Custo da Última Compra</label>
                    <input
                        name="custoUltimaCompra"
                        type="text"
                        class="form-control preco"
                        id="custoUltimaCompra"
                        placeholder="R$ 0,00"
                        value="{{ old('custoUltimaCompra') }}">
                    @error('custoUltimaCompra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3 mt-4">
                    <label class="form-label" for="custoUltimaVenda">Custo da Última Venda</label>
                    <input
                        name="custoUltimaVenda"
                        type="text"
                        class="form-control preco"
                        id="custoUltimaVenda"
                        placeholder="R$ 0,00"
                        value="{{ old('custoUltimaVenda') }}">
                    @error('custoUltimaVenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6 mt-4">
                    <label class="form-label" for="dtUltimaCompra">Data da Última Compra</label>
                    <input
                        name="dtUltimaCompra"
                        type="datetime-local"
                        class="form-control"
                        id="dtUltimaCompra"
                        value="{{ old('dtUltimaCompra') }}">
                    @error('dtUltimaCompra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6 mt-4">
                    <label class="form-label" for="dtUltimaVenda">Data da Última Venda</label>
                    <input
                        name="dtUltimaVenda"
                        type="datetime-local"
                        class="form-control"
                        id="dtUltimaVenda"
                        value="{{ old('dtUltimaVenda') }}">
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
@endsection

<!-- Carregar bibliotecas jQuery e jQuery Mask corretamente -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function($) {
        // Aplicar a máscara de preço
        $('.preco').mask('R$ 000.000.000,00', {
            reverse: true
        });
    });
</script>
