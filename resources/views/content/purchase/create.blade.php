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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Cadastrar Nota Fiscal de Compra</h4>
                    </div>
                    <div class="card-body" id="step1Content">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="numero" class="form-label">Número *</label>
                                <input
                                    type="text"
                                    name="numero"
                                    id="numero"
                                    class="form-control"
                                    value="{{ old('numero') }}"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="modelo" class="form-label">Modelo *</label>
                                <input
                                    type="text"
                                    name="modelo"
                                    id="modelo"
                                    class="form-control"
                                    value="{{ old('modelo') }}"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="serie" class="form-label">Série *</label>
                                <input
                                    type="text"
                                    name="serie"
                                    id="serie"
                                    class="form-control"
                                    value="{{ old('serie') }}"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="fornecedor" class="form-label">Fornecedor *</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="fornecedor"
                                        id="fornecedor"
                                        class="form-control"
                                        value="{{ old('fornecedor') }}"
                                        required>
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="tf-icons bx bx-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="data_emissao" class="form-label">Data Emissão *</label>
                                <input
                                    type="date"
                                    name="data_emissao"
                                    id="data_emissao"
                                    class="form-control"
                                    value="{{ old('data_emissao') }}"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="data_chegada" class="form-label">Data Chegada *</label>
                                <input
                                    type="date"
                                    name="data_chegada"
                                    id="data_chegada"
                                    class="form-control"
                                    value="{{ old('data_chegada') }}"
                                    required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="button" id="nextToStep2" class="btn btn-primary">Próxima Etapa</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Etapa 2: Produtos e Condições --}}
            <div id="step2" class="step">
                <div class="overlay" id="overlayStep2">
                    <div class="overlay-text text-center">
                        <p>Esta etapa será liberada após a etapa 1 ser concluída.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Adicionar Produtos</h5>
                    </div>
                    <div class="card-body" id="step2Content">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="produto_codigo" class="form-label">Código do Produto *</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="produto_codigo"
                                        id="produto_codigo"
                                        class="form-control"
                                        disabled>
                                    <button type="button" class="btn btn-outline-secondary" disabled>
                                        <i class="tf-icons bx bx-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="produto_nome" class="form-label">Produto *</label>
                                <input
                                    type="text"
                                    name="produto_nome"
                                    id="produto_nome"
                                    class="form-control"
                                    readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="unidade" class="form-label">Unidade *</label>
                                <input
                                    type="text"
                                    name="unidade"
                                    id="unidade"
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="quantidade" class="form-label">Quantidade *</label>
                                <input
                                    type="number"
                                    name="quantidade"
                                    id="quantidade"
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="preco" class="form-label">Preço *</label>
                                <input
                                    type="number"
                                    name="preco"
                                    id="preco"
                                    class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="button" id="addProduct" class="btn btn-secondary" disabled>Adicionar
                                Produto</button>
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

                        <div class="mt-4">
                            <button type="button" id="nextToStep3" class="btn btn-primary" disabled>Próxima
                                Etapa</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Etapa 3: Gerar Parcelas --}}
            <div id="step3" class="step">
                <div class="overlay" id="overlayStep3">
                    <div class="overlay-text text-center">
                        <p>Esta etapa será liberada após a etapa 2 ser concluída.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Condição de Pagamento</h5>
                    </div>
                    <div class="card-body" id="step3Content">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="parcela_numero" class="form-label">Nº Parcela *</label>
                                <input
                                    type="number"
                                    name="parcela_numero"
                                    id="parcela_numero"
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="col-md-3">
                                <label for="parcela_valor" class="form-label">Valor *</label>
                                <input
                                    type="number"
                                    name="parcela_valor"
                                    id="parcela_valor"
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="col-md-3">
                                <label for="parcela_data_vencimento" class="form-label">Data Vencimento *</label>
                                <input
                                    type="date"
                                    name="parcela_data_vencimento"
                                    id="parcela_data_vencimento"
                                    class="form-control"
                                    disabled>
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

                        <div class="mt-4">
                            <button type="submit" id="submitButton" class="btn btn-success" disabled>Finalizar
                                Cadastro</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- JavaScript para controle de etapas --}}
    <script>
        const nextToStep2 = document.getElementById("nextToStep2");
        const nextToStep3 = document.getElementById("nextToStep3");
        const submitButton = document.getElementById("submitButton");
        const step1 = document.getElementById("step1");
        const step2 = document.getElementById("step2");
        const step3 = document.getElementById("step3");

        // Função para ativar a próxima etapa
        function enableNextStep(currentStep, nextStep) {
            currentStep.classList.add("completed");
            nextStep.classList.remove("overlay");

            // Habilita campos da próxima etapa
            const fields = nextStep.querySelectorAll("input, button");
            fields.forEach(field => field.removeAttribute("disabled"));

            // Habilita o botão de próxima etapa
            const nextButton = nextStep.querySelector("button");
            if (nextButton) {
                nextButton.removeAttribute("disabled");
            }
        }

        // // Evento de click para avançar da Etapa 1 para Etapa 2
        // turnToStep1.addEventListener("click", () => {
        //     enableNextStep(step1, step2);
        // });

        // Evento de click para avançar da Etapa 1 para Etapa 2
        nextToStep2.addEventListener("click", () => {
            enableNextStep(step1, step2);
        });

        // Evento de click para avançar da Etapa 2 para Etapa 3
        nextToStep3.addEventListener("click", () => {
            enableNextStep(step2, step3);
        });

        // Evento para finalização do formulário
        submitButton.addEventListener("click", () => {
            // Aqui você pode executar a lógica de finalização ou validação
            document.getElementById("purchaseForm").submit();
        });
    </script>
@endsection
