@extends('layouts/contentNavbarLayout')

@section('title', 'Registrar Nota de Venda')

@section('content')
    @include('components.errorMessage')

    {{-- Formulário principal --}}
    <form id="saleForm" method="POST" action="{{ route('sale.store') }}">
        @csrf

        {{-- Etapa 1: Informações Básicas --}}
        <div id="etapa1" class="card mb-8">
            <div class="card-header d-flex justify-content-between">
                <h4 class="mb-0">Registrar Nota Fiscal de Venda</h4>
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
                    <div class="col-md-6">
                        <label class="form-label toUpperCase" for="customer_id">Cliente<span
                                class="labelRequired">*</span></label>
                        <div class="input-group">
                            <select
                                required
                                name="customer_id"
                                class="form-select toUpperCase elementsEtapa1"
                                id="customer_id">
                                <option value="" disabled selected>Selecione</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->id }} -
                                        {{ $customer->clienteRazaoSocial }}
                                    </option>
                                @endforeach
                            </select>

                            <button class="btn btn-outline-secondary elementsEtapa1"
                                style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#customerModal">
                                <span class="tf-icons bx bx-search bx-18px"></span>
                            </button>
                        </div>
                        @error('customer_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="dataEmissao" class="form-label toUpperCase">Data Emissão</label>
                        <input
                            disabled
                            type="date"
                            name="dataEmissaoLabel"
                            id="dataEmissao"
                            class="form-control toUpperCase"
                            value="{{ now()->format('Y-m-d') }}"
                            required>
                        <input type="hidden" name="dataEmissao" value="{{ now()->format('Y-m-d') }}">

                    </div>
                </div>

                <div class="d-flex justify-content-between mt-10">
                    <div class="customer-details-block">
                        <h6 class="mb-2">Dados do cliente</h6>
                        <div class="d-flex">
                            <p class="mb-0">Selecione um cliente</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" id="actionsEtapa1">
                        <a href="{{ route('sale.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button type="button" class="btn btn-primary toUpperCase"
                            id="verificarNota">Prosseguir</button>
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
                        <div class="col-md-8">
                            <label class="form-label toUpperCase" for="product_id">Produto</label>
                            <div class="input-group">
                                <select name="product_id" class="form-select toUpperCase elementsEtapa2"
                                    id="product_id">
                                    <option value="" disabled selected>Selecione</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-nome="{{ $product->nome }}"
                                            data-medida="{{ $product->measure->sigla }}"
                                            data-comissao="{{ $product->percentualComissao }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->id }} - {{ $product->nome }}
                                            ({{ $product->measure->sigla }})
                                        </option>
                                    @endforeach
                                </select>

                                <button class="btn btn-outline-secondary elementsEtapa2"
                                    style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#productModal">
                                    <span class="tf-icons bx bx-search bx-18px"></span>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="qtdProduto" class="form-label toUpperCase">Quantidade</label>
                            <input type="number" name="qtdProduto" id="qtdProduto" placeholder="0"
                                max="9999" min="0"
                                oninput="limitInputLength(this, 4)" class="form-control toUpperCase elementsEtapa2">
                        </div>

                        <div class="col-md-2">
                            <label for="precoProduto" class="form-label toUpperCase preco">Preço</label>
                            <input type="text" name="precoProduto" placeholder="R$ 00,00" maxlength="17"
                                id="precoProduto"
                                class="form-control preco toUpperCase elementsEtapa2" value="{{ old('preco') }}">
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
                                <th>Preço total</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody id="product-list" class="table-border"></tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-start mt-10">
                    <!-- Seção Frete e Observações -->
                    <div class="flex-grow-1">
                        <h5>Frete</h5>
                        <div class="d-flex">
                            <div style="width: 120px;">
                                <label class="form-label toUpperCase"
                                    for="tipoFrete">Tipo Frete</label>
                                <select required name="tipoFrete" class="form-select toUpperCase elementsEtapa2"
                                    id="tipoFrete">
                                    <option value="CIF" selected>CIF</option>
                                    <option value="FOB">FOB</option>
                                </select>
                            </div>
                            <div class="ms-4">
                                <label for="valorFrete" class="form-label toUpperCase preco">Valor Frete</label>
                                <input type="text" name="valorFrete" placeholder="R$ 00,00" maxlength="17"
                                    id="valorFrete" class="form-control preco toUpperCase elementsEtapa2"
                                    value="{{ old('valorFrete') }}">
                            </div>
                            <div class="ms-4">
                                <label for="valorSeguro" class="form-label toUpperCase preco">Valor Seguro</label>
                                <input type="text" name="valorSeguro" placeholder="R$ 00,00" maxlength="17"
                                    id="valorSeguro" class="form-control preco toUpperCase elementsEtapa2"
                                    value="{{ old('valorSeguro') }}">
                            </div>
                            <div class="ms-4">
                                <label for="outrasDespesas" class="form-label toUpperCase preco">Outras despesas</label>
                                <input type="text" name="outrasDespesas" placeholder="R$ 00,00" maxlength="17"
                                    id="outrasDespesas" class="form-control preco toUpperCase elementsEtapa2"
                                    value="{{ old('outrasDespesas') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Seção Totais -->
                    <div class="ms-4" style="width: 170px;">
                        <h5>Desconto</h5>
                        <div class="">
                            <label for="desconto" class="form-label toUpperCase">Desconto (%)</label>
                            <input type="number" name="desconto" placeholder="0" max="100"
                                min="0"
                                oninput="limitInputLength(this, 3)" id="desconto"
                                class="form-control toUpperCase text-end elementsEtapa2"
                                value="{{ old('desconto') }}">
                        </div>
                    </div>

                    <!-- Seção Totais -->
                    <div class="ms-4">
                        <h5>Totais</h5>
                        <div class="d-flex">
                            <div>
                                <label for="qtdTotalProdutos"
                                    class="form-label toUpperCase">QTD. produtos</label>
                                <input disabled type="text" name="qtdTotalProdutos" placeholder="0"
                                    id="qtdTotalProdutos" class="form-control toUpperCase text-end"
                                    value="{{ old('qtdTotalProdutos') }}">
                            </div>
                            <div class="ms-4">
                                <label for="totalProdutos" class="form-label toUpperCase preco">Total
                                    produtos</label>
                                <input disabled type="text" name="totalProdutosDisplay" placeholder="R$ 00,00"
                                    id="totalProdutos" class="form-control preco toUpperCase text-end"
                                    value="{{ old('totalProdutos') }}">
                                <input type="hidden" name="totalProdutos" id="totalProdutosHidden">
                            </div>
                            <div class="ms-4">
                                <label for="totalPagar" class="form-label toUpperCase preco">Valor da nota</label>
                                <input disabled type="text" name="totalPagarDisplay" placeholder="R$ 00,00"
                                    id="totalPagar" class="form-control preco toUpperCase text-end"
                                    value="{{ old('totalPagar') }}">
                                <input type="hidden" name="totalPagar" id="totalPagarHidden">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-10" id="actionsEtapa2">
                    <a href="{{ route('sale.index') }}"
                        class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>

                    <button data-bs-toggle="modal" data-bs-target="#confirmarVoltarEtapa2"
                        type="button" class="btn btn-secondary toUpperCase me-4">Voltar Etapa</button>

                    <button type="button" id="prosseguirEstapa3"
                        class="btn btn-primary toUpperCase">Prosseguir</button>

                    <!-- Modal de confirmação para voltar etapa -->
                    <div class="modal fade" id="confirmarVoltarEtapa2" tabindex="-1"
                        aria-labelledby="modalConfirmarVoltarEtapa2" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalConfirmarVoltarEtapa2">Remover Produtos e Voltar
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Para alterar os dados da nota fiscal, nenhum produto pode estar adicionado. Deseja
                                    remover os produtos e voltar?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary toUpperCase me-4"
                                        data-bs-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary toUpperCase"
                                        id="limparDadosEtapa2">Sim, remover e voltar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Etapa 3: Condições de Pagamento --}}
        <div id="etapa3" class="step">
            <div class="card mb-8">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h5 class="mb-0">Condição de Pagamento</h5>
                    <p class="badge bg-label-primary">Etapa 3</p>
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
                                <select required name="payment_term_id" class="form-select toUpperCase elementsEtapa3"
                                    id="payment_term_id">
                                    <option value="" disabled selected>Selecione</option>
                                    @foreach ($paymentTerms as $paymentTerm)
                                        <option value="{{ $paymentTerm->id }}"
                                            data-installments="{{ $paymentTerm->installments }}"
                                            {{ old('payment_term_id') == $paymentTerm->id ? 'selected' : '' }}>
                                            {{ $paymentTerm->id }} - {{ $paymentTerm->condicaoPagamento }}
                                        </option>
                                    @endforeach
                                </select>

                                <button class="btn btn-outline-secondary elementsEtapa3"
                                    style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                    type="button" data-bs-toggle="modal" data-bs-target="#paymentTermModal">
                                    <span class="tf-icons bx bx-search bx-18px"></span>
                                </button>
                            </div>
                        </div>

                        <div class="ms-6">
                            <button type="button" class="btn btn-outline-primary toUpperCase elementsEtapa3"
                                id="addParcela">
                                Gerar Parcelas
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
                        <a href="{{ route('sale.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>

                        <button data-bs-toggle="modal" data-bs-target="#confirmarVoltarEtapa3"
                            type="button" class="btn btn-secondary toUpperCase me-4">Voltar Etapa</button>

                        <button type="submit" class="btn btn-success toUpperCase">Registrar venda</button>

                        <!-- Modal de confirmação para voltar etapa -->
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
                                        Deseja remover a condição de pagamento e voltar?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary toUpperCase me-4"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <button type="button" class="btn btn-primary toUpperCase"
                                            id="limparDadosEtapa3">Sim, remover e voltar</button>
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

    @include('content.sale.modal.selectCustomer')
    @include('content.sale.modal.selectProduct')
    @include('content.sale.modal.selectPaymentTerm')

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
        let subTotal = 0;
        let valorTotalProdutos = 0;
        let valorFrete = 0;
        let valorSeguro = 0;
        let outrasDespesas = 0;
        let descontoTotal = 0;
        let acrescimoTotal = 0;
        let produtosAdicionados = new Set();
        let parcelasGeradas = new Set();
        let paymentTermsData = {};
        let parcelasAtivas = false;

        // Função para limitar o tamanho dos campos
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
            actionButtonsE1.removeClass('d-none');
            inputsE1.each(function() {
                $(this).prop('disabled', false);
            });

            // Desabilitando Etapa 2
            alertEtapa2.removeClass('d-none');
            actionButtonsE2.addClass('d-none');
            inputsE2.each(function() {
                $(this).prop('disabled', true);
            });

            // Desabilitando Etapa 3
            alertEtapa3.removeClass('d-none');
            actionButtonsE3.addClass('d-none');
            inputsE3.each(function() {
                $(this).prop('disabled', true);
            });
        }

        // Função para liberar a Etapa 2
        function liberarEtapa2() {
            const inputsE1 = elementosEtapa1.find('.elementsEtapa1');
            const inputsE2 = elementosEtapa2.find('.elementsEtapa2');
            const inputsE3 = elementosEtapa3.find('.elementsEtapa3');

            // Desabilitando Etapa 1
            actionButtonsE1.addClass('d-none');
            inputsE1.each(function() {
                $(this).prop('disabled', true);
            });

            // Liberando Etapa 2
            alertEtapa2.addClass('d-none');
            actionButtonsE2.removeClass('d-none');
            inputsE2.each(function() {
                $(this).prop('disabled', false);
            });

            // Desabilitando Etapa 3
            alertEtapa3.removeClass('d-none');
            actionButtonsE3.addClass('d-none');
            inputsE3.each(function() {
                $(this).prop('disabled', true);
            });
        }

        // Função para liberar a Etapa 3
        function liberarEtapa3() {
            const inputsE1 = elementosEtapa1.find('.elementsEtapa1');
            const inputsE2 = elementosEtapa2.find('.elementsEtapa2');
            const inputsE3 = elementosEtapa3.find('.elementsEtapa3');

            // Desabilitando Etapa 1
            actionButtonsE1.addClass('d-none');
            inputsE1.each(function() {
                $(this).prop('disabled', true);
            });

            // Desabilitando Etapa 2
            actionButtonsE2.addClass('d-none');
            inputsE2.each(function() {
                $(this).prop('disabled', true);
            });

            // Liberando Etapa 3
            alertEtapa3.addClass('d-none');
            actionButtonsE3.removeClass('d-none');
            inputsE3.each(function() {
                $(this).prop('disabled', false);
            });
        }

        // Função para limpar dados da Etapa 2
        function limparDadosEtapa2() {
            $('#limparDadosEtapa2').on('click', function() {
                // Limpa campos de produto
                $('#product_id').val('').trigger('change');
                $('#qtdProduto').val('');
                $('#precoProduto').val('');
                $('#descontoProduto').val('');
                $('#acrescimoProduto').val('');

                // Limpa campos de valores adicionais
                $('#valorFrete').val('').trigger('change');
                $('#valorSeguro').val('').trigger('change');
                $('#outrasDespesas').val('').trigger('change');

                // Limpa campos de totais
                $('#qtdTotalProdutos').val('');
                $('#subTotal').val('');
                $('#totalProdutos').val('');
                $('#totalPagar').val('');
                $('#subTotalHidden').val('');
                $('#totalProdutosHidden').val('');
                $('#totalPagarHidden').val('');
                $('#desconto').val('');
                $('#acrescimo').val('');

                // Limpa observações
                $('#observacao').val('');

                // Limpa tabela de produtos
                $('#product-list').empty();

                // Reseta variáveis globais
                subTotal = 0;
                valorTotalProdutos = 0;
                valorFrete = 0;
                valorSeguro = 0;
                outrasDespesas = 0;
                descontoTotal = 0;
                acrescimoTotal = 0;
                produtosAdicionados.clear();

                // Fecha modal
                $('#confirmarVoltarEtapa2').modal('hide');

                // Libera etapa 1
                liberarEtapa1();
            });
        }

        // Função para limpar dados da Etapa 3
        function limparDadosEtapa3() {
            $('#limparDadosEtapa3').on('click', function() {
                // Limpa campos
                $('#payment_term_id').val('');
                $('#parcelaList').empty();

                // Reseta variáveis
                parcelasGeradas.clear();
                paymentTermsData = {};
                parcelasAtivas = false;

                // Fecha modal
                $('#confirmarVoltarEtapa3').modal('hide');

                // Libera etapa 2
                liberarEtapa2();
            });
        }

        // Funções para formatação de valores
        function arredondar(valor) {
            return Math.round(valor * 100) / 100;
        }

        function formatarMoeda(valor) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(valor);
        }

        function converterValorParaNumero(valorStr) {
            if (!valorStr) return 0;
            return parseFloat(valorStr.replace('R$', '').replace(/\./g, '').replace(',', '.') || 0);
        }

        // Funções para datas
        function calcularDataVencimento(dias) {
            const data = new Date();
            data.setDate(data.getDate() + dias);
            return data;
        }

        function formatarData(data) {
            return data.toLocaleDateString('pt-BR');
        }

        // Função para calcular comissão
        function calcularComissao(valor, percentualComissao) {
            return arredondar((valor * percentualComissao) / 100);
        }

        // Função para atualizar totais
        function atualizarTotais() {
            // Calcula desconto total
            const percentualDesconto = parseFloat($('#desconto').val() || 0);
            descontoTotal = arredondar((subTotal * percentualDesconto) / 100);

            // Calcula acréscimo total
            const percentualAcrescimo = parseFloat($('#acrescimo').val() || 0);
            acrescimoTotal = arredondar((subTotal * percentualAcrescimo) / 100);

            // Calcula valor total dos produtos com desconto e acréscimo
            valorTotalProdutos = arredondar(subTotal - descontoTotal + acrescimoTotal);

            // Calcula valor total a pagar incluindo frete, seguro e outras despesas
            const totalComFrete = arredondar(valorTotalProdutos + valorFrete + valorSeguro + outrasDespesas);

            // Atualiza campos na interface
            $('#qtdTotalProdutos').val(produtosAdicionados.size);
            $('#subTotal').val(formatarMoeda(subTotal));
            $('#totalProdutos').val(formatarMoeda(valorTotalProdutos));
            $('#totalPagar').val(formatarMoeda(totalComFrete));

            // Atualiza campos hidden
            $('#subTotalHidden').val(subTotal);
            $('#totalProdutosHidden').val(valorTotalProdutos);
            $('#totalPagarHidden').val(totalComFrete);

            // Atualiza campos de valores adicionais
            $('#valorFrete').val(formatarMoeda(valorFrete));
            $('#valorSeguro').val(formatarMoeda(valorSeguro));
            $('#outrasDespesas').val(formatarMoeda(outrasDespesas));
        }

        // Função para buscar dados do cliente
        function buscarDadosCliente() {
            $('#customer_id').on('change', function() {
                const customerId = $(this).val();
                const customerDetailsBlock = $('.customer-details-block');

                axios.get(`{{ route('customer.findId', ':id') }}`.replace(':id', customerId))
                    .then(response => {
                        if (response.data.success) {
                            const customer = response.data.customer;
                            const documentoLabel = customer.tipoPessoa === 'F' ? 'CPF' : 'CNPJ';

                            customerDetailsBlock.html(`
                        <h6 class="mb-2">Dados do cliente</h6>
                        <div class="d-flex">
                            <p class="mb-0">Telefone: ${customer.celular}</p>
                            <p class="mb-0 ms-4">E-mail: ${customer.email}</p>
                            <p class="mb-0 ms-4">${documentoLabel}: ${customer.cpfCnpj}</p>
                        </div>
                    `);
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar dados:', error);
                    });
            });
        }

        // Função para verificar nota fiscal
        function verificarNotaFiscal() {
            $('#verificarNota').on('click', function(e) {
                e.preventDefault();

                const numeroNota = document.getElementById("numeroNota").value;
                const modelo = document.getElementById("modelo").value;
                const serie = document.getElementById("serie").value;
                const customer_id = document.getElementById("customer_id").value;

                if (!numeroNota || !modelo || !serie || !customer_id) {
                    alert("Por favor, preencha todos os campos obrigatórios antes de prosseguir.");
                    return;
                }

                axios.post('{{ route('sale.check') }}', {
                        numeroNota: numeroNota,
                        modelo: modelo,
                        serie: serie,
                        customer_id: customer_id
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

        // Função para adicionar produto
        function adicionarProduto() {
            $('#add-product').on('click', function() {
                const product_id = $('#product_id').val();
                const qtdProduto = parseInt($('#qtdProduto').val());
                const precoProduto = converterValorParaNumero($('#precoProduto').val());
                const descontoProduto = parseFloat($('#descontoProduto').val() || 0);
                const acrescimoProduto = parseFloat($('#acrescimoProduto').val() || 0);
                const produtoNome = $('#product_id option:selected').data('nome');
                const unidadeProduto = $('#product_id option:selected').data('medida');
                const percentualComissao = parseFloat($('#product_id option:selected').data('comissao') || 0);

                if (!product_id || !qtdProduto || isNaN(precoProduto)) {
                    return alert('Preencha todos os campos obrigatórios.');
                }

                if (descontoProduto > 100 || descontoProduto < 0) {
                    return alert('O desconto deve estar entre 0 e 100%.');
                }

                if (acrescimoProduto > 100 || acrescimoProduto < 0) {
                    return alert('O acréscimo deve estar entre 0 e 100%.');
                }

                if (produtosAdicionados.has(product_id.toString())) {
                    return alert('Este produto já foi adicionado.');
                }

                const precoTotalProduto = arredondar(precoProduto * qtdProduto);
                const valorDesconto = arredondar((descontoProduto / 100) * precoTotalProduto);
                const valorAcrescimo = arredondar((acrescimoProduto / 100) * precoTotalProduto);
                const precoTotal = arredondar(precoTotalProduto - valorDesconto + valorAcrescimo);
                const valorComissao = calcularComissao(precoTotal, percentualComissao);

                subTotal = arredondar(subTotal + precoTotal);
                produtosAdicionados.add(product_id.toString());

                $('#product-list').append(`
            <tr class="product-item" data-id="${product_id}" data-price="${precoTotal}">
                <td>${product_id}</td>
                <td>${produtoNome}</td>
                <td>${unidadeProduto}</td>
                <td>${qtdProduto}</td>
                <td>${formatarMoeda(precoProduto)}</td>
                <td>${descontoProduto}%</td>
                <td>${acrescimoProduto}%</td>
                <td>${formatarMoeda(valorComissao)}</td>
                <td>${formatarMoeda(precoTotal)}</td>
                <td class="size-col-action">
                    <button type="button" class="btn btn-outline-danger rounded-pill border-0 remove-product elementsEtapa2"><span class="tf-icons bx bx-trash bx-22px"></span>
                    </button>
                </td>
                <input type="hidden" name="produtos[${product_id}][product_id]" value="${product_id}">
                <input type="hidden" name="produtos[${product_id}][produtoNome]" value="${produtoNome}">
                <input type="hidden" name="produtos[${product_id}][qtdProduto]" value="${qtdProduto}">
                <input type="hidden" name="produtos[${product_id}][precoProduto]" value="${precoProduto}">
                <input type="hidden" name="produtos[${product_id}][descontoProduto]" value="${descontoProduto}">
                <input type="hidden" name="produtos[${product_id}][precoTotal]" value="${precoTotal}">
            </tr>
        `);

                atualizarTotais();

                // Limpa os campos do produto
                $('#product_id').val('').trigger('change');
                $('#qtdProduto').val('');
                $('#precoProduto').val('');
            });
        }

        // Função para remover produtos
        function removeProdutos() {
            $(document).on('click', '.remove-product', function() {
                const productItem = $(this).closest('.product-item');
                const product_id = productItem.data('id').toString();
                const precoTotal = parseFloat(productItem.data('price'));

                produtosAdicionados.delete(product_id);
                subTotal = arredondar(subTotal - precoTotal);

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
                    const response = await axios.get(`{{ route('payment_term.installments', ':id') }}`.replace(
                        ':id', payment_term_id));
                    const parcelas = response.data.installments;

                    $('#parcelaList').empty();
                    parcelasGeradas.clear();

                    let totalPercentual = 0;

                    parcelas.forEach((parcela) => {
                        const valorParcela = arredondar((valorTotal * parcela.percentual) / 100);
                        const dataVencimento = calcularDataVencimento(parcela.dias);
                        totalPercentual += parseFloat(parcela.percentual);

                        $('#parcelaList').append(`
                    <tr class="parcela-item" data-parcela="${parcela.parcela}">
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

        // Função para atualizar valores adicionais
        function atualizarValoresAdicionais() {
            // Atualização do frete
            $('#valorFrete').on('change', function() {
                valorFrete = converterValorParaNumero($(this).val());
                atualizarTotais();
            });

            // Atualização do seguro
            $('#valorSeguro').on('change', function() {
                valorSeguro = converterValorParaNumero($(this).val());
                atualizarTotais();
            });

            // Atualização de outras despesas
            $('#outrasDespesas').on('change', function() {
                outrasDespesas = converterValorParaNumero($(this).val());
                atualizarTotais();
            });

            // Atualização do desconto geral
            $('#desconto').on('change', function() {
                atualizarTotais();
            });

            // Atualização do acréscimo geral
            $('#acrescimo').on('change', function() {
                atualizarTotais();
            });
        }

        // Função para validar formulário
        function validarFormulario() {
            $('#saleForm').on('submit', function(e) {
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

        // Função para validar datas
        function validaDatas() {
            function criarDataLocal(dateString) {
                const partes = dateString.split('-');
                return new Date(partes[0], partes[1] - 1, partes[2]);
            }

            // Validação da Data de Saída
            $('#dataSaida').on('change', function() {
                const dataEmissaoString = document.getElementById('dataEmissao').value;
                const dataSaidaString = document.getElementById('dataSaida').value;
                const dataAtual = new Date();
                dataAtual.setHours(0, 0, 0, 0);

                const dataEmissao = dataEmissaoString ? criarDataLocal(dataEmissaoString) : null;
                const dataSaida = dataSaidaString ? criarDataLocal(dataSaidaString) : null;

                if (dataSaida) {
                    if (dataSaida > dataAtual) {
                        alert('A data de saída não pode ser maior que o dia atual.');
                        document.getElementById('dataSaida').value = '';
                        return;
                    }

                    if (dataEmissao && dataSaida < dataEmissao) {
                        alert('A data de saída não pode ser anterior à data de emissão.');
                        document.getElementById('dataSaida').value = '';
                    }
                }
            });

            // Validação da Data de Emissão
            $('#dataEmissao').on('change', function() {
                const dataEmissaoString = $('#dataEmissao').val();
                const dataSaidaString = $('#dataSaida').val();
                const dataAtual = new Date();
                dataAtual.setHours(0, 0, 0, 0);

                const dataEmissao = dataEmissaoString ? criarDataLocal(dataEmissaoString) : null;
                const dataSaida = dataSaidaString ? criarDataLocal(dataSaidaString) : null;

                if (dataEmissao) {
                    if (dataEmissao > dataAtual) {
                        alert('A data de emissão não pode ser maior que o dia atual.');
                        $('#dataEmissao').val('');
                        return;
                    }

                    if (dataSaida && dataSaida < dataEmissao) {
                        alert('A data de saída não pode ser anterior à data de emissão.');
                        $('#dataEmissao').val('');
                    }
                }
            });
        }

        // Inicialização
        $(document).ready(function() {
            // Inicia na primeira etapa
            liberarEtapa1();

            // Inicializa variáveis globais
            produtosAdicionados.clear();
            parcelasGeradas.clear();
            subTotal = 0;
            valorTotalProdutos = 0;
            valorFrete = 0;
            valorSeguro = 0;
            outrasDespesas = 0;
            descontoTotal = 0;
            acrescimoTotal = 0;

            // Inicializa todas as funcionalidades
            buscarDadosCliente();
            verificarNotaFiscal();
            validaDatas();
            adicionarProduto();
            removeProdutos();
            atualizarValoresAdicionais();
            limparDadosEtapa2();
            limparDadosEtapa3();
            gerarParcelas();
            validarFormulario();

            // Prosseguir para Etapa 3
            $('#prosseguirEstapa3').on('click', function() {
                if (produtosAdicionados.size === 0) {
                    alert('Adicione ao menos 1 produto para prosseguir.');
                    return;
                }
                liberarEtapa3();
            });

            // Habilita campos antes do submit
            $('#saleForm').on('submit', function(e) {
                const inputsE1 = elementosEtapa1.find('.elementsEtapa1');
                const inputsE2 = elementosEtapa2.find('.elementsEtapa2');
                const inputsE3 = elementosEtapa3.find('.elementsEtapa3');

                inputsE1.prop('disabled', false);
                inputsE2.prop('disabled', false);
                inputsE3.prop('disabled', false);

                return true;
            });

            // Formatação dos campos de preço
            $('.preco').on('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = (value / 100).toFixed(2);
                e.target.value = formatarMoeda(parseFloat(value));
            });

            // Limpa parcelas ao mudar condição de pagamento
            $('#payment_term_id').on('change', function() {
                $('#parcelaList').empty();
                parcelasGeradas.clear();
            });
        });
    </script>
@endsection
