@extends('layouts/contentNavbarLayout')

@section('title', 'Registrar Nota de Compra')

@section('content')
    <div>
        @include('components.errorMessage')

        {{-- Formulário principal --}}
        <form id="purchaseForm" method="POST" action="{{ route('purchase.store') }}">
            @csrf

            {{-- Etapa 1: Informações Básicas --}}
            <div id="etapa1" class="card mb-8">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mb-0">Registrar Nota Fiscal de Compra</h4>

                    <p class="badge bg-label-primary">Etapa 1</p>
                </div>
                <div class="card-body mt-1" id="step1Content">
                    <h5 class="mb-4">Dados da Nota Fiscal</h5>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="numeroNota" class="form-label toUpperCase">Número <span
                                    class="labelRequired">*</span></label>
                            <input
                                type="number"
                                name="numeroNota"
                                id="numeroNota"
                                class="form-control toUpperCase elementsEtapa1"
                                value="{{ old('numeroNota') }}"
                                placeholder="0000000000"
                                max="9999999999"
                                min="0"
                                oninput="limitInputLength(this, 10)"
                                required>
                        </div>
                        <div class="col-md-1">
                            <label for="modelo" class="form-label toUpperCase">Modelo <span
                                    class="labelRequired">*</span></label>
                            <input
                                type="number"
                                name="modelo"
                                id="modelo"
                                class="form-control toUpperCase elementsEtapa1"
                                value="{{ old('modelo') }}"
                                placeholder="00"
                                max="99"
                                min="0"
                                oninput="limitInputLength(this, 2)"
                                required>
                        </div>
                        <div class="col-md-1">
                            <label for="serie" class="form-label toUpperCase">Série <span
                                    class="labelRequired">*</span></label>
                            <input
                                type="number"
                                name="serie"
                                placeholder="000"
                                max="999"
                                min="0"
                                oninput="limitInputLength(this, 3)"
                                id="serie"
                                class="form-control toUpperCase elementsEtapa1"
                                value="{{ old('serie') }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label toUpperCase" for="supplier_id">Fornecedor<span
                                    class="labelRequired">*</span></label>
                            <div class="input-group">
                                <select
                                    required
                                    name="supplier_id"
                                    class="form-select toUpperCase elementsEtapa1"
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
                                <button class="btn btn-outline-secondary elementsEtapa1"
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
                            <label for="dataEmissao" class="form-label toUpperCase">Data Emissão <span
                                    class="labelRequired">*</span></label>
                            <input
                                type="date"
                                name="dataEmissao"
                                id="dataEmissao"
                                class="form-control toUpperCase elementsEtapa1"
                                value="{{ old('dataEmissao') }}"
                                required>
                        </div>



                        <div class="col-md-2">
                            <label for="dataChegada" class="form-label toUpperCase">Data Chegada <span
                                    class="labelRequired">*</span></label>
                            <input
                                type="date"
                                name="dataChegada"
                                id="dataChegada"
                                class="form-control toUpperCase elementsEtapa1"
                                value="{{ old('dataChegada') }}"
                                required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-10">

                        <div class="supplier-details-block">
                            <h6 class="mb-2">Dados do fornecedor</h6>
                            <div class="d-flex">
                                <p class="mb-0">Selecione um fornecedor</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" id="actionsEtapa1">
                            <a href="{{ route('purchase.index') }}"
                                class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                            <button type="button"
                                class="btn btn-primary toUpperCase" id="verificarNota">Prosseguir</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Etapa 2: Produtos e Condições --}}
            <div id="etapa2" class="card mb-8">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h5 class="mb-0">Produtos</h5>

                    <p class="badge bg-label-primary">Etapa 2</p>
                </div>
                <div class="container" id="alertEtapa2">
                    <div class="alert alert-secondary text-center toUpperCase">
                        Complete a etapa 1 para adicionar produtos
                    </div>
                </div>
                <div class="card-body" id="step2Content">
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="row flex-grow-1">
                            <div class="col-md-6">
                                <label class="form-label toUpperCase" for="product_id">Produto</label>
                                <div class="input-group">
                                    <select name="product_id" class="form-select toUpperCase elementsEtapa2"
                                        id="product_id">
                                        <option value="" disabled selected>Selecione</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                data-nome="{{ $product->nome }}"
                                                data-medida="{{ $product->measure->sigla }}"
                                                {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->id }} - {{ $product->nome }}
                                                ({{ $product->measure->sigla }})
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Botão de ação do modal de selecionar forma de pagamento --}}
                                    <button class="btn btn-outline-secondary elementsEtapa2"
                                        style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#productModal">
                                        <span class="tf-icons bx bx-search bx-18px"></span>
                                    </button>
                                    {{-- End Button --}}
                                </div>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="qtdProduto" class="form-label toUpperCase">Quantidade</label>
                                <input type="number" name="qtdProduto" id="qtdProduto" placeholder="0"
                                    max="9999" min="0"
                                    oninput="limitInputLength(this, 4)" class="form-control toUpperCase elementsEtapa2">
                            </div>

                            <div class="col-md-2">
                                <label for="precoProduto" class="form-label toUpperCase preco">Preço </label>
                                <input type="text" name="precoProduto" placeholder="R$ 00,00" maxlength="17"
                                    id="precoProduto"
                                    class="form-control preco toUpperCase elementsEtapa2" value="{{ old('preco') }}">
                            </div>

                            <div class="col-md-2">
                                <label for="descontoProduto" class="form-label toUpperCase">Desconto (%)</label>
                                <input type="number" name="descontoProduto" placeholder="0" max="100"
                                    min="0"
                                    oninput="limitInputLength(this, 3)" id="descontoProduto"
                                    class="form-control desconto toUpperCase elementsEtapa2"
                                    value="{{ old('desconto') }}">
                            </div>

                        </div>
                        <div class="ms-6">
                            <button type="button" class="btn btn-outline-primary toUpperCase elementsEtapa2"
                                id="add-product">Adicionar Produto</button>
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
                                    <th>Desconto</th>
                                    <th>Preço total</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody id="product-list" class="table-border"></tbody>
                        </table>
                    </div>


                    <div class="d-flex justify-content-between align-items-start mt-10">
                        <!-- Seção Frete -->
                        <div>
                            <h5>Frete</h5>
                            <div class="d-flex">
                                <div class="col-md-2 mb-3">
                                    <label class="form-label toUpperCase" for="tipoFrete">Tipo Frete<span
                                            class="labelRequired">*</span></label>
                                    <select required name="tipoFrete" class="form-select toUpperCase elementsEtapa2"
                                        id="tipoFrete">
                                        <option value="CIF" selected>CIF</option>
                                        <option value="FOB">FOB</option>
                                    </select>
                                    @error('tipoPessoa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 ms-4">
                                    <label for="valorFrete" class="form-label toUpperCase preco">Valor Frete <span
                                            class="labelRequired">*</span></label>
                                    <input
                                        type="text"
                                        name="valorFrete"
                                        placeholder="R$ 00,00"
                                        maxlength="17"
                                        id="valorFrete"
                                        class="form-control preco toUpperCase elementsEtapa2"
                                        value="{{ old('valorFrete') }}">
                                </div>
                                <div class="col-md-3 ms-4">
                                    <label for="valorSeguro" class="form-label toUpperCase preco">Valor Seguro <span
                                            class="labelRequired">*</span></label>
                                    <input
                                        type="text"
                                        name="valorSeguro"
                                        placeholder="R$ 00,00"
                                        maxlength="17"
                                        id="valorSeguro"
                                        class="form-control preco toUpperCase elementsEtapa2"
                                        value="{{ old('valorSeguro') }}">
                                </div>
                                <div class="col-md-3 ms-4">
                                    <label for="outrasDespesas" class="form-label toUpperCase preco">Outras despesas
                                        <span class="labelRequired">*</span></label>
                                    <input
                                        type="text"
                                        name="outrasDespesas"
                                        placeholder="R$ 00,00"
                                        maxlength="17"
                                        id="outrasDespesas"
                                        class="form-control preco toUpperCase elementsEtapa2"
                                        value="{{ old('outrasDespesas') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Seção Totais -->
                        <div class="ms-4">
                            <h5>Totais</h5>
                            <div class="d-flex">
                                <div class="col-3">
                                    <label for="qtdTotalProdutos" class="form-label toUpperCase">QTD.
                                        produtos</label>
                                    <input
                                        disabled
                                        type="text"
                                        name="qtdTotalProdutos"
                                        placeholder="0"
                                        id="qtdTotalProdutos"
                                        class="form-control toUpperCase text-end"
                                        value="{{ old('qtdTotalProdutos') }}">
                                </div>
                                <div class="ms-4">
                                    <label for="totalProdutos" class="form-label toUpperCase preco">valor
                                        produtos</label>
                                    <input
                                        disabled
                                        type="text"
                                        name="totalPagarDisplay"
                                        placeholder="R$ 00,00"
                                        maxlength="17"
                                        id="totalProdutos"
                                        class="form-control preco toUpperCase text-end"
                                        value="{{ old('totalProdutos') }}">
                                    <input type="hidden" name="totalProdutos" id="totalProdutosHidden">
                                </div>
                                <div class="ms-4">
                                    <label for="totalPagar" class="form-label toUpperCase preco">valor da nota</label>
                                    <input
                                        disabled
                                        type="text"
                                        name="totalPagarDisplay"
                                        placeholder="R$ 00,00"
                                        maxlength="17"
                                        id="totalPagar"
                                        class="form-control preco toUpperCase text-end"
                                        value="{{ old('totalPagar') }}">
                                    <input type="hidden" name="totalPagar" id="totalPagarHidden">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end mt-10" id="actionsEtapa2">
                        <a href="{{ route('purchase.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase ">Cancelar</a>

                        <!-- Botão que abre o modal de exclusão -->
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#confirmarVoltarEtapa2"
                            type="button"
                            class="btn btn-secondary toUpperCase me-4  ">Voltar Etapa</i>
                        </button>

                        <button type="button" id="prosseguirEstapa3"
                            class="btn btn-primary toUpperCase">PROSSEGUIR</button>

                        <!-- Componente de modal de confirmação -->
                        <div class="modal fade" id="confirmarVoltarEtapa2" tabindex="-1"
                            aria-labelledby="modalConfirmarVoltarEtapa2" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalConfirmarVoltarEtapa2">Remover Produtos e
                                            Voltar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Para alterar os dados da nota fiscal, nenhum poduto pode estar adicionado. Deseja
                                        remover os produtos e voltar?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary toUpperCase me-4"
                                            data-bs-dismiss="modal">Fechar </button>

                                        <button type="button" class="btn btn-primary toUpperCase"
                                            id="limparDadosEtapa2">Sim, remover e
                                            voltar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Etapa 3: Gerar Parcelas --}}
            <div id="etapa3" class="step">
                <div class="card mb-8">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h5 class="mb-0">Condição de Pagamento</h5>

                        <p class="badge bg-label-primary">Etapa 2</p>
                    </div>
                    <div class="container" id="alertEtapa3">
                        <div class="alert alert-secondary text-center toUpperCase">
                            Complete as etapas 1 e 2 para prosseguir
                        </div>
                    </div>
                    <div class="card-body" id="step3Content">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="flex-grow-1">
                                <label class="form-label toUpperCase" for="payment_term_id">Condição de Pagamento<span
                                        class="labelRequired">*</span></label>
                                <div class="input-group">
                                    <select
                                        required
                                        name="payment_term_id"
                                        class="form-select toUpperCase elementsEtapa3"
                                        id="payment_term_id">
                                        <option value="" disabled selected>Selecione</option>
                                        @foreach ($paymentTerms as $paymentTerm)
                                            <option value="{{ $paymentTerm->id }}"
                                                data-installments="{{ $paymentTerm->installments }}"
                                                {{ old('payment_term_id') == $paymentTerm->id ? 'selected' : '' }}>
                                                {{ $paymentTerm->id }} -
                                                {{ $paymentTerm->condicaoPagamento }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button class="btn btn-outline-secondary elementsEtapa3"
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

                            <div class="ms-6">
                                <button type="button"
                                    class="btn btn-outline-primary toUpperCase elementsEtapa3 "id="addParcela">Gerar
                                    Parcelas
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nº Parcela</th>
                                        <th>Forma de pagamento</th>
                                        <th>Data de Vencimento</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody id="parcelaList"></tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-10" id="actionsEtapa3">
                            <a href="{{ route('purchase.index') }}"
                                class="btn btn-outline-secondary me-4 toUpperCase ">Cancelar</a>

                            <!-- Botão que abre o modal de exclusão -->
                            <button
                                data-bs-toggle="modal"
                                data-bs-target="#confirmarVoltarEtapa3"
                                type="button"
                                class="btn btn-secondary toUpperCase me-4  ">Voltar Etapa</i>
                            </button>

                            <button type="submit" class="btn btn-success toUpperCase">Registrar compra</button>

                            <!-- Componente de modal de confirmação -->
                            <div class="modal fade" id="confirmarVoltarEtapa3" tabindex="-1"
                                aria-labelledby="modalConfirmarVoltarEtapa3" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalConfirmarVoltarEtapa3">Remover Condição de
                                                Pagamento e Voltar?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Para alterar produtos, nenhuma condição de pagamento pode estar selecionada.
                                            Deseja
                                            remover a condição de pagamento e voltar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary toUpperCase me-4"
                                                data-bs-dismiss="modal">Fechar </button>

                                            <button type="button" class="btn btn-primary toUpperCase"
                                                id="limparDadosEtapa3">Sim, remover e
                                                voltar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('content.product.modal.selectSupplier')
    @include('content.purchase.modal.selectProduct')
    @include('content.purchase.modal.selectPaymentTerm')

    <script>
        // Elementos das etapas para manipular
        const elementosEtapa1 = $('#etapa1');
        const actionButtonsE1 = $('#actionsEtapa1');

        const elementosEtapa2 = $('#etapa2');
        const alertEtapa2 = $('#alertEtapa2');
        const actionButtonsE2 = $('#actionsEtapa2');

        const elementosEtapa3 = $('#etapa3');
        const alertEtapa3 = $('#alertEtapa3');
        const actionButtonsE3 = $('#actionsEtapa3');

        // Variáveis globais para controle
        let valorTotalProdutos = 0;
        let valorFrete = 0;
        let valorSeguro = 0;
        let outrasDespesas = 0;
        let produtosAdicionados = new Set();
        let parcelasGeradas = new Set();
        let paymentTermsData = {};
        let parcelasAtivas = false;


        // Limita o tamanho dos campos
        function limitInputLength(input, length) {
            if (input.value.length > length) {
                input.value = input.value.slice(0, length);
            }
        }

        // Função para liberar a Etapa 1
        function liberarEtapa1() {

            const inputsE1 = elementosEtapa1.find('.elementsEtapa1');
            const inputsE2 = elementosEtapa2.find('.elementsEtapa2');
            const inputsE3 = elementosEtapa3.find('.elementsEtapa3');

            // Liberando inputs da Etapa 1
            actionButtonsE1.removeClass('d-none'); // Exibe os botões da Etapa 1
            inputsE1.each(function() {
                $(this).prop('disabled', false); // Habilita os campos da Etapa 1
            });

            // Desabilitando inputs e escondendo botões da Etapa 2
            alertEtapa2.removeClass('d-none'); // Mostra a mensagem de alerta para a Etapa 2
            actionButtonsE2.addClass('d-none'); // Esconde os botões da Etapa 2
            inputsE2.each(function() {
                $(this).prop('disabled', true); // Desabilita os campos da Etapa 2
            });

            // Desabilitando inputs e escondendo botões da Etapa 3
            alertEtapa3.removeClass('d-none'); // Mostra a mensagem de alerta para a Etapa 3
            actionButtonsE3.addClass('d-none'); // Esconde os botões da Etapa 3
            inputsE3.each(function() {
                $(this).prop('disabled', true); // Desabilita os campos da Etapa 3
            });
        }

        // Função para liberar a Etapa 2
        function liberarEtapa2() {

            const inputsE1 = elementosEtapa1.find('.elementsEtapa1');
            const inputsE2 = elementosEtapa2.find('.elementsEtapa2');
            const inputsE3 = elementosEtapa3.find('.elementsEtapa3');

            // Desabilitando inputs e escondendo botões da Etapa 1
            inputsE1.each(function() {
                $(this).prop('disabled', true); // Desabilita os campos da Etapa 1
            });
            actionButtonsE1.addClass('d-none'); // Esconde os botões da Etapa 1

            // Liberando inputs da Etapa 2
            alertEtapa2.addClass('d-none'); // Esconde a mensagem de alerta da Etapa 2
            actionButtonsE2.removeClass('d-none'); // Exibe os botões de ação da Etapa 2
            inputsE2.each(function() {
                $(this).prop('disabled', false); // Habilita os campos da Etapa 2
            });

            // Desabilitando inputs e escondendo botões da Etapa 3
            alertEtapa3.removeClass('d-none'); // Mostra a mensagem de alerta para a Etapa 3
            actionButtonsE3.addClass('d-none'); // Esconde os botões da Etapa 3
            inputsE3.each(function() {
                $(this).prop('disabled', true); // Desabilita os campos da Etapa 3
            });
        }

        // Função para liberar a Etapa 3
        function liberarEtapa3() {

            const inputsE1 = elementosEtapa1.find('.elementsEtapa1');
            const inputsE2 = elementosEtapa2.find('.elementsEtapa2');
            const inputsE3 = elementosEtapa3.find('.elementsEtapa3');

            // Desabilitando inputs e escondendo botões da Etapa 1
            actionButtonsE1.addClass('d-none'); // Esconde os botões da Etapa 1
            inputsE1.each(function() {
                $(this).prop('disabled', true); // Desabilita os campos da Etapa 1
            });

            // Desabilitando inputs e escondendo botões da Etapa 2
            actionButtonsE2.addClass('d-none'); // Esconde os botões da Etapa 2
            inputsE2.each(function() {
                $(this).prop('disabled', true); // Desabilita os campos da Etapa 2
            });

            // Liberando inputs da Etapa 3
            alertEtapa3.addClass('d-none'); // Esconde a mensagem de alerta da Etapa 3
            actionButtonsE3.removeClass('d-none'); // Exibe os botões de ação da Etapa 3
            inputsE3.each(function() {
                $(this).prop('disabled', false); // Habilita os campos da Etapa 3
            });
        }

        function limparDadosEtapa2() {
            $('#limparDadosEtapa2').on('click', function() {
                // Limpa os campos de produto
                $('#product_id').val('').trigger('change');
                $('#qtdProduto').val('');
                $('#precoProduto').val('');
                $('#descontoProduto').val('');

                // Limpa os campos de valores adicionais
                $('#valorFrete').val('').trigger('change');
                $('#valorSeguro').val('').trigger('change');
                $('#outrasDespesas').val('').trigger('change');

                // Limpa os campos de totais
                $('#qtdTotalProdutos').val('');
                $('#totalProdutos').val('');
                $('#totalPagar').val('');
                $('#totalProdutosHidden').val('');
                $('#totalPagarHidden').val('');

                // Limpa a tabela de produtos
                $('#product-list').empty();

                // Reseta as variáveis globais
                valorTotalProdutos = 0;
                valorFrete = 0;
                valorSeguro = 0;
                outrasDespesas = 0;
                produtosAdicionados.clear();

                // Fecha o modal
                $('#confirmarVoltarEtapa2').modal('hide');

                // Libera etapa 1
                liberarEtapa1();
            });
        }

        function limparDadosEtapa3() {
            $('#limparDadosEtapa3').on('click', function() {
                // Limpa os campos de produto
                $('#payment_term_id').val('');

                // Limpa a tabela de produtos
                $('#parcelaList').empty();

                // Reseta as variáveis globais
                parcelasGeradas = new Set();
                paymentTermsData = {};
                parcelasAtivas = false;

                // Fecha o modal
                $('#confirmarVoltarEtapa3').modal('hide');

                // Libera etapa 1
                liberarEtapa2();
            });
        }

        // Função para arredondar valores para 2 casas decimais
        function arredondar(valor) {
            return Math.round(valor * 100) / 100;
        }

        // Função para formatar valores monetários no padrão brasileiro
        function formatarMoeda(valor) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(valor);
        }

        // Função para converter valor em formato brasileiro para número
        function converterValorParaNumero(valorStr) {
            if (!valorStr) return 0;
            return parseFloat(valorStr.replace('R$', '').replace(/\./g, '').replace(',', '.') || 0);
        }

        // Função para calcular data de vencimento
        function calcularDataVencimento(dias) {
            const data = new Date();
            data.setDate(data.getDate() + dias);
            return data;
        }

        // Função para formatar data
        function formatarData(data) {
            return data.toLocaleDateString('pt-BR');
        }

        // Função para atualizar os valores totais
        function atualizarTotais() {
            const totalSemFrete = valorTotalProdutos;
            const totalComFrete = arredondar(totalSemFrete + valorFrete + valorSeguro + outrasDespesas);

            $('#qtdTotalProdutos').val(produtosAdicionados.size);
            $('#totalProdutos').val(formatarMoeda(totalSemFrete));
            $('#totalPagar').val(formatarMoeda(totalComFrete));

            // Atualiza o campo hidden com o valor sem formatação
            $('#totalProdutosHidden').val(formatarMoeda(totalSemFrete));
            $('#totalPagarHidden').val(formatarMoeda(totalComFrete));


            // Atualiza os campos de valores adicionais com a formatação correta
            $('#valorFrete').val(formatarMoeda(valorFrete));
            $('#valorSeguro').val(formatarMoeda(valorSeguro));
            $('#outrasDespesas').val(formatarMoeda(outrasDespesas));
        }

        // Função para inicializar os dados das condições de pagamento
        function initializePaymentTerms() {
            const paymentTerms = document.querySelectorAll('[data-installments]');

            paymentTerms.forEach(term => {
                const termId = term.dataset.paymentTermId;
                const installments = JSON.parse(term.dataset.installments);
                paymentTermsData[termId] = installments;
            });
        }

        // Validação de datas
        function validaDatas() {
            function criarDataLocal(dateString) {
                const partes = dateString.split('-');
                return new Date(partes[0], partes[1] - 1, partes[2]);
            }

            // Validação da Data de Chegada
            $('#dataChegada').on('change', function() {
                const dataEmissaoString = document.getElementById('dataEmissao').value;
                const dataChegadaString = document.getElementById('dataChegada').value;
                const dataAtual = new Date();
                dataAtual.setHours(0, 0, 0, 0);

                const dataEmissao = dataEmissaoString ? criarDataLocal(dataEmissaoString) : null;
                const dataChegada = dataChegadaString ? criarDataLocal(dataChegadaString) : null;

                if (dataChegada) {
                    if (dataChegada > dataAtual) {
                        alert('A data de chegada não pode ser maior que o dia atual.');
                        document.getElementById('dataChegada').value = '';
                        return;
                    }

                    if (dataEmissao && dataChegada < dataEmissao) {
                        alert('A data de chegada não pode ser anterior à data de emissão.');
                        document.getElementById('dataChegada').value = '';
                    }
                }
            });

            // Validação da Data de Emissão
            $('#dataEmissao').on('change', function() {
                const dataEmissaoString = $('#dataEmissao').val();
                const dataChegadaString = $('#dataChegada').val();
                const dataAtual = new Date();
                dataAtual.setHours(0, 0, 0, 0);

                const dataEmissao = dataEmissaoString ? criarDataLocal(dataEmissaoString) : null;
                const dataChegada = dataChegadaString ? criarDataLocal(dataChegadaString) : null;

                $('.error-message').remove();

                if (dataEmissao) {
                    if (dataEmissao > dataAtual) {
                        alert('A data de emissão não pode ser maior que o dia atual.');
                        $('#dataEmissao').val('');
                        return;
                    }

                    if (dataChegada && dataChegada < dataEmissao) {
                        alert('A data de chegada não pode ser anterior à data de emissão.');
                        $('#dataEmissao').val('');
                    }
                }
            });
        }

        // Busca dados do fornecedor
        function buscarDadosFornecedor() {
            $('#supplier_id').on('change', function() {
                const supplierId = $(this).val();
                const supplierDetailsBlock = $('.supplier-details-block');

                axios.get(`{{ route('supplier.findId', ':id') }}`.replace(':id', supplierId))
                    .then(response => {
                        if (response.data.success) {
                            const supplier = response.data.supplier;
                            const documentoLabel = supplier.tipoPessoa === 'F' ? 'CPF' : 'CNPJ';

                            supplierDetailsBlock.html(`
                        <h6 class="mb-2">Dados do fornecedor</h6>
                        <div class="d-flex">
                            <p class="mb-0">Telefone: ${supplier.celular}</p>
                            <p class="mb-0 ms-4">E-mail: ${supplier.email}</p>
                            <p class="mb-0 ms-4">${documentoLabel}: ${supplier.cpfCnpj}</p>
                        </div>
                    `);
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar dados:', error);
                    });
            });
        }



        // Verificar nota fiscal
        function verificarNotaFiscal() {
            $('#verificarNota').on('click', function(e) {
                e.preventDefault();

                const numeroNota = document.getElementById("numeroNota").value;
                const modelo = document.getElementById("modelo").value;
                const serie = document.getElementById("serie").value;
                const supplier_id = document.getElementById("supplier_id").value;

                if (!numeroNota || !modelo || !serie || !supplier_id) {
                    alert("Por favor, preencha todos os campos obrigatórios antes de prosseguir.");
                    return;
                }

                axios.post('{{ route('purchase.check') }}', {
                        numeroNota: numeroNota,
                        modelo: modelo,
                        serie: serie,
                        supplier_id: supplier_id
                    })
                    .then(response => {
                        if (response.data.exists) {
                            alert("Esta nota fiscal já está cadastrada no sistema!");
                        } else {
                            liberarEtapa2();
                        }
                    })
                    .catch(error => {
                        console.error("Erro ao verificar nota fiscal:", error);
                        alert("Ocorreu um erro ao verificar a nota fiscal. Tente novamente.");
                    });
            });
        }

        // Adicionar produto
        function adicionarProduto() {
            $('#add-product').on('click', function() {
                const product_id = $('#product_id').val();
                const qtdProduto = parseInt($('#qtdProduto').val());
                const precoProduto = converterValorParaNumero($('#precoProduto').val());
                const descontoProduto = parseFloat($('#descontoProduto').val() || 0);
                const produtoNome = $('#product_id option:selected').data('nome');
                const unidadeProduto = $('#product_id option:selected').data('medida');

                if (!product_id || !qtdProduto || isNaN(precoProduto)) {
                    return alert('Preencha todos os campos obrigatórios.');
                }

                if (descontoProduto > 100 || descontoProduto < 0) {
                    return alert('O desconto deve estar entre 0 e 100%.');
                }

                if (produtosAdicionados.has(product_id.toString())) {
                    return alert('Este produto já foi adicionado.');
                }

                const precoTotalProduto = arredondar(precoProduto * qtdProduto);
                const valorDesconto = arredondar((descontoProduto / 100) * precoTotalProduto);
                const precoTotal = arredondar(precoTotalProduto - valorDesconto);

                valorTotalProdutos = arredondar(valorTotalProdutos + precoTotal);
                produtosAdicionados.add(product_id.toString());

                $('#product-list').append(`
            <tr class="product-item" data-id="${product_id}" data-price="${precoTotal}">
                <td>${product_id}</td>
                <td>${produtoNome}</td>
                <td>${unidadeProduto}</td>
                <td>${qtdProduto}</td>
                <td>${formatarMoeda(precoProduto)}</td>
                <td>${descontoProduto}%</td>
                <td>${formatarMoeda(precoTotal)}</td>
                <td class="size-col-action">
                    <button type="button" class="btn btn-outline-danger rounded-pill border-0 remove-product elementsEtapa2">
                        <span class="tf-icons bx bx-trash bx-22px"></span>
                    </button>
                </td>
                <input type="hidden" name="produtos[${product_id}][product_id]" value="${product_id}">
                <input type="hidden" name="produtos[${product_id}][produtoNome]" value="${produtoNome}">
                <input type="hidden" name="produtos[${product_id}][unidadeProduto]" value="${unidadeProduto}">
                <input type="hidden" name="produtos[${product_id}][qtdProduto]" value="${qtdProduto}">
                <input type="hidden" name="produtos[${product_id}][precoProduto]" value="${precoProduto}">
                <input type="hidden" name="produtos[${product_id}][descontoProduto]" value="${descontoProduto}">
                <input type="hidden" name="produtos[${product_id}][precoTotal]" value="${precoTotal}">
            </tr>
        `);

                atualizarTotais();

                $('#product_id').val('').trigger('change');
                $('#qtdProduto').val('');
                $('#precoProduto').val('');
                $('#descontoProduto').val('');
            });
        }

        // Remover produtos
        function removeProdutos() {
            $(document).on('click', '.remove-product', function() {
                const productItem = $(this).closest('.product-item');
                const product_id = productItem.data('id').toString();
                const precoTotal = parseFloat(productItem.data('price'));

                produtosAdicionados.delete(product_id);
                valorTotalProdutos = arredondar(valorTotalProdutos - precoTotal);

                productItem.remove();
                atualizarTotais();
            });
        }

        // Função para gerar parcelas
        function gerarParcelas(recalculo = false) {
            const processarParcelas = async () => {

                const payment_term_id = $('#payment_term_id').val();

                if (!payment_term_id) {
                    if (!recalculo) alert('Selecione uma condição de pagamento.');
                    return;
                }

                const valorTotal = converterValorParaNumero($('#totalPagar').val());

                if (valorTotal <= 0) {
                    if (!recalculo) alert('Não há valor a ser parcelado.');
                    return;
                }

                try {
                    // Busca as parcelas via GET
                    const response = await axios.get(`{{ route('payment_term.installments', ':id') }}`.replace(
                        ':id', payment_term_id));
                    const parcelas = response.data.installments;

                    console.log(parcelas);


                    $('#parcelaList').empty();

                    parcelasGeradas.clear();

                    let totalPercentual = 0;

                    parcelas.forEach((parcela) => {
                        const valorParcela = arredondar((valorTotal * parcela.percentual) / 100);
                        const dataVencimento = calcularDataVencimento(parcela.dias);
                        totalPercentual += parseFloat(parcela.percentual);

                        $('#parcelaList').append(`<tr class="parcela-item" data-parcela="${parcela.parcela}">
                                                      <td>${parcela.parcela}ª Parcela</td>
                                                      <td>${parcela.payment_form.formaPagamento}</td>
                                                      <td>${formatarData(dataVencimento)}</td>
                                                      <td>${formatarMoeda(valorParcela)}</td>

                                                      <input type="hidden" name="parcelas[${parcela.parcela}][payment_form_id]" value="${parcela.payment_form.id}">
                                                      <input type="hidden" name="parcelas[${parcela.parcela}][parcela]" value="${parcela.parcela}">
                                                      <input type="hidden" name="parcelas[${parcela.parcela}][dias]" value="${parcela.dias}">
                                                      <input type="hidden" name="parcelas[${parcela.parcela}][percentual]" value="${parcela.percentual}">
                                                      <input type="hidden" name="parcelas[${parcela.parcela}][valor]" value="${valorParcela}">
                                                      <input type="hidden" name="parcelas[${parcela.parcela}][dataVencimento]" value="${dataVencimento.toISOString().split('T')[0]}">
                                                  </tr>
                              `);

                        parcelasGeradas.add(parcela.parcela);
                    });


                } catch (error) {
                    console.error('Erro ao buscar parcelas:', error);
                    if (!recalculo) {
                        alert('Erro ao gerar parcelas. Tente novamente.');
                    }
                }
            };

            if (recalculo) {
                processarParcelas();
            } else {
                $('#addParcela').on('click', processarParcelas);
            }
        }

        // Atualizar valores adicionais
        function atualizarValoresAdicionais() {
            $('#valorFrete').on('change', function() {
                valorFrete = converterValorParaNumero($(this).val());
                atualizarTotais();
            });

            $('#valorSeguro').on('change', function() {
                valorSeguro = converterValorParaNumero($(this).val());
                atualizarTotais();
            });

            $('#outrasDespesas').on('change', function() {
                outrasDespesas = converterValorParaNumero($(this).val());
                atualizarTotais();
            });
        }

        // Validação do formulário
        function validarFormulario() {
            $('#actionEtapa3').on('click', function(e) {
                if (parcelasGeradas.size === 0) {
                    e.preventDefault();
                    alert('Gere as parcelas antes de cadastrar a nota.');
                    return false;
                }

                const valorTotal = converterValorParaNumero($('#totalPagar').val());
                const totalParcelas = Array.from(document.querySelectorAll('input[name$="[valor]"]'))
                    .reduce((total, input) => total + parseFloat(input.value), 0);

                if (Math.abs(totalParcelas - valorTotal) > 0.01) {
                    e.preventDefault();
                    alert('O valor total das parcelas não corresponde ao valor da nota.');
                    return false;
                }
            });
        }

        // APENAS PARA DEV

        function popularCamposTeste() {
            // Preenche campos básicos
            $('#numeroNota').val('1234567890');
            $('#modelo').val('55');
            $('#serie').val('1');
            $('#dataEmissao').val('2024-03-20');
            $('#dataChegada').val('2024-03-21');

            // Preenche campos de produto
            $('#qtdProduto').val('10');
            $('#precoProduto').val('R$ 100,00').trigger('change');
            $('#descontoProduto').val('10');

            // Preenche valores adicionais e dispara eventos de change
            $('#valorFrete').val('R$ 50,00').trigger('change');
            $('#valorSeguro').val('R$ 25,00').trigger('change');
            $('#outrasDespesas').val('R$ 15,00').trigger('change');
        }

        // Inicialização
        $(document).ready(function() {

            liberarEtapa1();

            // Inicialização das variáveis
            produtosAdicionados.clear();
            parcelasGeradas.clear();
            valorTotalProdutos = 0;
            valorFrete = 0;
            valorSeguro = 0;
            outrasDespesas = 0;

            // Inicializa os dados das condições de pagamento
            initializePaymentTerms();

            // Inicializa todas as funcionalidades
            buscarDadosFornecedor();
            verificarNotaFiscal();
            validaDatas();
            adicionarProduto();
            removeProdutos();
            atualizarValoresAdicionais();


            // APENAS PARA DEVS
            popularCamposTeste();

            limparDadosEtapa2();
            limparDadosEtapa3()

            gerarParcelas();
            validarFormulario();

            $('#prosseguirEstapa3').on('click', function() {
                if (produtosAdicionados.size === 0) {
                    alert('Adicione ao menos 1 produto para prosseguir.');
                    return;
                }
                liberarEtapa3();
            });

            $('#purchaseForm').on('submit', function(e) {
                // Remove o disabled de todos os campos antes do submit
                const inputsE1 = elementosEtapa1.find('.elementsEtapa1');
                const inputsE2 = elementosEtapa2.find('.elementsEtapa2');
                const inputsE3 = elementosEtapa3.find('.elementsEtapa3');

                // Habilita todos os campos
                inputsE1.prop('disabled', false);
                inputsE2.prop('disabled', false);
                inputsE3.prop('disabled', false);

                // O formulário será enviado normalmente após habilitar os campos
                return true;
            });

            // Formatação dos campos de preço
            $('.preco').on('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = (value / 100).toFixed(2);
                e.target.value = formatarMoeda(parseFloat(value));
            });

            // Limpa parcelas ao mudar a condição de pagamento
            $('#payment_term_id').on('change', function() {
                $('#parcelaList').empty();
                parcelasGeradas.clear();
            });
        });
    </script>

@endsection
