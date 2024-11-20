@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Nota de Compra')

@section('content')
    <div>
        @include('components.errorMessage')

        {{-- Formulário principal --}}
        <form id="purchaseForm" method="POST" action="{{ route('purchase.store') }}">
            @csrf

            {{-- Etapa 1: Informações Básicas --}}
            <div id="step1" class="step">
                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-between">
                        <h4>Registrar Nota de Compra</h5>
                        </h4>

                        <h6>Etapa 1</h6>
                    </div>
                    <div class="card-body" id="step1Content">
                        <div class="row">
                            <div class="col-md-1">
                                <label for="numero" class="form-label">Número <span
                                        class="labelRequired">*</span></label>
                                <input
                                    type="text"
                                    name="numero"
                                    id="numero"
                                    class="form-control"
                                    value="{{ old('numero') }}"
                                    placeholder="000"
                                    required>
                            </div>
                            <div class="col-md-1">
                                <label for="modelo" class="form-label">Modelo <span
                                        class="labelRequired">*</span></label>
                                <input
                                    type="text"
                                    name="modelo"
                                    id="modelo"
                                    class="form-control"
                                    value="{{ old('modelo') }}"
                                    placeholder="00"
                                    required>
                            </div>
                            <div class="col-md-1">
                                <label for="serie" class="form-label">Série <span
                                        class="labelRequired">*</span></label>
                                <input
                                    type="text"
                                    name="serie"
                                    placeholder="0"
                                    id="serie"
                                    class="form-control"
                                    value="{{ old('serie') }}"
                                    required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label toUpperCase" for="supplier_id">Fornecedor<span
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



                            <div class="col-md-2">
                                <label for="data_emissao" class="form-label">Data Emissão <span
                                        class="labelRequired">*</span></label>
                                <input
                                    type="date"
                                    name="data_emissao"
                                    id="data_emissao"
                                    class="form-control"
                                    value="{{ old('data_emissao') }}"
                                    required>
                            </div>
                            <div class="col-md-2">
                                <label for="data_chegada" class="form-label">Data Chegada <span
                                        class="labelRequired">*</span></label>
                                <input
                                    type="date"
                                    name="data_chegada"
                                    id="data_chegada"
                                    class="form-control"
                                    value="{{ old('data_chegada') }}"
                                    required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-10">

                            <a href="{{ route('purchase.index') }}"
                                class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                            <button type="button" id="actionEtapa1" class="btn btn-primary">PROSSEGUIR</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between">
                    <h5>Produtos</h5>

                    <h6>Etapa 2</h6>
                </div>
                <div class="card-body ">
                    <span class="d-flex justify-content-center">
                        Para adicionar produtos, primeiro informe os dados da nota fiscal.
                    </span>
                </div>
            </div>

            {{-- Etapa 2: Produtos e Condições --}}
            <div id="step2" class="step d-none">

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h5 class="mb-0">Adicionar Produtos</h5>
                    </div>
                    <div class="card-body" id="step2Content">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="row flex-grow-1">
                                <div class="col-md-6">
                                    <label class="form-label toUpperCase" for="product_id">Produto<span
                                            class="labelRequired">*</span></label>
                                    <div class="input-group">
                                        <select
                                            required
                                            name="product_id"
                                            class="form-select toUpperCase"
                                            id="product_id">
                                            <option value="" disabled selected>Selecione</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                                    {{ $product->id }} -
                                                    {{ $product->nome }}
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
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="unidade" class="form-label">Unidade <span
                                            class="labelRequired">*</span></label>
                                    <input
                                        type="text"
                                        name="unidade"
                                        id="unidade"
                                        class="form-control"
                                        disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="quantidade" class="form-label">Quantidade <span
                                            class="labelRequired">*</span></label>
                                    <input
                                        type="number"
                                        name="quantidade"
                                        id="quantidade"
                                        class="form-control"
                                        disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="preco" class="form-label">Preço <span
                                            class="labelRequired">*</span></label>
                                    <input
                                        type="number"
                                        name="preco"
                                        id="preco"
                                        class="form-control"
                                        disabled>
                                </div>

                            </div>
                            <div class="ms-6">
                                <button type="button" class="btn btn-primary toUpperCase" id="addProduct">Adicionar
                                    Produto</button>
                            </div>
                        </div>


                        <div class="table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Produto</th>
                                        <th>Unidade</th>
                                        <th>Quantidade</th>
                                        <th>Preço Unitário</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="productList"></tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-10">

                            <a href="{{ route('purchase.index') }}"
                                class="btn btn-outline-secondary me-4 toUpperCase d-none">Cancelar</a>
                            {{-- <button type="button" id="turnEtapa1"
                                class="btn btn-secondary toUpperCase me-4  d-none">Etapa
                                anterior</button> --}}

                            <!-- Botão que abre o modal de exclusão -->
                            <button
                                data-bs-toggle="modal"
                                data-bs-target="#turnStepConfirmation"
                                type="button"
                                class="btn btn-secondary toUpperCase me-4  d-none">Etapa
                                anterior</i>
                            </button>

                            <!-- Componente de modal de confirmação -->
                            @include('components.modalTurnStep', [
                                'objId' => 'step1',
                                'objNome' => 'Etapa 1',
                            ])
                            <button type="button" id="actionEtapa2"
                                class="btn btn-primary toUpperCase d-none">PROSSEGUIR</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between">
                    <h5>Condição de Pagamento</h5>

                    <h6>Etapa 3</h6>
                </div>
                <div class="card-body ">
                    <span class="d-flex justify-content-center">
                        Para definir a condição de pagamento, primeiro preencha as etapas 1 e 2.
                    </span>
                </div>
            </div>

            {{-- Etapa 3: Gerar Parcelas --}}
            <div id="step3" class="step d-none">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Condição de Pagamento</h5>
                    </div>
                    <div class="card-body" id="step3Content">
                        <div class="row">
                            <div class="col flex-grow-1">
                                <label class="form-label toUpperCase" for="payment_term_id">Condição de Pagamento<span
                                        class="labelRequired">*</span></label>
                                <div class="input-group">
                                    <select
                                        required
                                        name="payment_term_id"
                                        class="form-select toUpperCase"
                                        id="payment_term_id">
                                        <option value="" disabled selected>Selecione</option>
                                        @foreach ($paymentTerms as $paymentTerm)
                                            <option value="{{ $paymentTerm->id }}"
                                                {{ old('payment_term_id') == $paymentTerm->id ? 'selected' : '' }}>
                                                {{ $paymentTerm->id }} -
                                                {{ $paymentTerm->condicaoPagamento }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button class="btn btn-outline-secondary"
                                        style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#paymentTermModal">
                                        <span class="tf-icons bx bx-search bx-18px"></span>
                                    </button>
                                </div>

                                @error('payment_term_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="button" id="addParcela" class="btn btn-secondary" disabled>Adicionar
                                Parcela</button>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nº Parcela</th>
                                        <th>Valor</th>
                                        <th>Data de Vencimento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="parcelaList"></tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-10">

                            <a href="{{ route('purchase.index') }}"
                                class="btn btn-outline-secondary me-4 toUpperCase d-none">Cancelar</a>
                            <button type="button" id="turnEtapa2" class="btn btn-secondary toUpperCase me-4 d-none"
                                disabled>Etapa
                                anterior</button>
                            <button type="button" id="actionEtapa3" class="btn btn-success toUpperCase d-none"
                                disabled>cadastrar nota</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('content.product.modal.selectSupplier')

    <script>
        // Função para habilitar os campos e botões da etapa atual e desativar os da etapa anterior
        function toggleSteps(currentStep, nextStep) {
            // Oculta os botões da etapa atual e desativa os campos
            const currentButtons = currentStep.querySelectorAll(".btn");
            currentButtons.forEach(button => button.classList.add("d-none"));

            const currentFields = currentStep.querySelectorAll("input, button, select");
            currentFields.forEach(field => field.setAttribute("disabled", "true"));

            // Exibe os botões da próxima etapa e ativa os campos
            const nextButtons = nextStep.querySelectorAll(".btn");
            nextButtons.forEach(button => button.classList.remove("d-none"));

            const nextFields = nextStep.querySelectorAll("input, button, select");
            nextFields.forEach(field => field.removeAttribute("disabled"));
        }

        // Seletores das etapas e botões
        const step1 = document.getElementById("step1");
        const step2 = document.getElementById("step2");
        const step3 = document.getElementById("step3");

        const actionEtapa1 = document.getElementById("actionEtapa1");
        const actionEtapa2 = document.getElementById("actionEtapa2");
        const actionEtapa3 = document.getElementById("actionEtapa3");
        const submitButton = document.getElementById("submitButton");

        // Inicializa os estados das etapas
        window.onload = () => {
            // Etapa 1 inicia ativa
            const step1Fields = step1.querySelectorAll("input, button, select");
            step1Fields.forEach(field => field.removeAttribute("disabled"));

            // Etapas 2 e 3 começam inativas
            [step2, step3].forEach(step => {
                const fields = step.querySelectorAll("input, button, select");
                fields.forEach(field => field.setAttribute("disabled", "true"));

                const buttons = step.querySelectorAll(".btn");
                buttons.forEach(button => button.classList.add("d-none"));
            });
        };

        // Eventos para avançar entre as etapas
        actionEtapa1.addEventListener("click", () => {
            toggleSteps(step1, step2);
        });

        // Eventos para avançar entre as etapas
        turnEtapa1.addEventListener("click", () => {
            toggleSteps(step2, step1);
        });

        actionEtapa2.addEventListener("click", () => {
            toggleSteps(step2, step3);
        });

        // Eventos para avançar entre as etapas
        turnEtapa2.addEventListener("click", () => {
            toggleSteps(step3, step2);
        });

        submitButton.addEventListener("click", () => {
            // Lógica de envio do formulário
            document.getElementById("purchaseForm").submit();
        });
    </script>


@endsection
