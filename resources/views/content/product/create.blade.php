@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Produto')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar Produto</h4>

        <div class="card-body">
            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('product.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-7">
                    <label class="form-label toUpperCase" for="nome">Nome do produto<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control toUpperCase"
                        id="nome"
                        placeholder="nome do produto"
                        maxlength="50"
                        value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label toUpperCase" for="estoque">Estoque<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="estoque"
                        type="number"
                        class="form-control toUpperCase"
                        id="estoque"
                        placeholder="estoque"
                        value="{{ old('estoque') }}">
                    @error('estoque')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-3">
                    <label class="form-label toUpperCase" for="measure_id">Medida<span
                            class="labelRequired">*</span></label>
                    <div class="input-group">
                        <select
                            required
                            name="measure_id"
                            class="form-select toUpperCase"
                            id="measure_id">
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($measures as $measure)
                                <option value="{{ $measure->id }}">
                                    {{ $measure->id }} - {{ $measure->nome }}
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

                <div class="col-2 mt-4">
                    <label class="form-label toUpperCase preco" for="precoVenda">Preço de Venda<span
                            class="labelRequired">*</span></label>
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

                <div class="col-2 mt-4">
                    <label class="form-label toUpperCase preco" for="precoCusto">Preço de Custo</label>
                    <input
                        disabled
                        name="precoCusto"
                        type="text"
                        class="form-control preco"
                        id="precoCusto"
                        placeholder="R$ 0,00"
                        value="{{ old('precoCusto') }}">
                </div>

                <div class="col-2 mt-4">
                    <label class="form-label toUpperCase preco" for="custoUltimaCompra">Custo da Última Compra</label>
                    <input
                        disabled
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

                <div class="col-2 mt-4">
                    <label class="form-label toUpperCase preco" for="custoUltimaVenda">Preço da Última Venda</label>
                    <input
                        disabled
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

                <div class="col-2 mt-4">
                    <label class="form-label toUpperCase" for="dtUltimaCompra">Data da Última Compra</label>
                    <input
                        disabled
                        name="dtUltimaCompra"
                        type="datetime-local"
                        class="form-control toUpperCase"
                        id="dtUltimaCompra"
                        value="{{ old('dtUltimaCompra') }}">
                    @error('dtUltimaCompra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2 mt-4">
                    <label class="form-label toUpperCase" for="dtUltimaVenda">Data da Última Venda</label>
                    <input
                        disabled
                        name="dtUltimaVenda"
                        type="datetime-local"
                        class="form-control toUpperCase"
                        id="dtUltimaVenda"
                        value="{{ old('dtUltimaVenda') }}">
                    @error('dtUltimaVenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col mt-4">
                    <label class="form-label toUpperCase" for="supplier_id">Fornecedor principal<span
                            class="labelRequired">*</span></label>
                    <div class="input-group">
                        <select
                            required
                            name="supplier_id"
                            class="form-select toUpperCase"
                            id="supplier_id">
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->id }} -
                                    {{ $supplier->fornecedorRazaoSocial }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Botão de ação do modal de selecionar forma de pagamento --}}
                        <button class="btn btn-outline-secondary"
                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#supplierModal">
                            <span class="tf-icons bx bx-search bx-18px"></span>
                        </button>
                        {{-- End Button --}}
                    </div>
                    @error('supplier_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-10">
                    <div>
                        <input type="hidden" name="ativo" value="1">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="ativo"
                            id="ativo"
                            value="1"
                            disabled
                            checked>
                        <label class="form-check-label toUpperCase" for="ativo">Ativo</label>
                    </div>
                    <div>
                        <a href="{{ route('product.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button type="submit" class="btn btn-success toUpperCase">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Selecionar Medida -->
    @include('content.product.modal.selectMeasure')
    @include('content.product.modal.selectSupplier')

    <script>
        document.querySelectorAll('.preco').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = (value / 100).toFixed(2).replace('.', ',');
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                e.target.value = 'R$ ' + value;
            });
        });
    </script>
@endsection
