@extends('layouts/contentNavbarLayout')

@section('title', 'Registrar Nota de Compra')

@section('content')
    <div>
        @include('components.errorMessage')

        {{-- Formulário principal --}}
        {{-- <div id="purchaseForm" method="POST" action="{{ route('purchase.store') }}">
            @csrf --}}

        <div>
            {{-- Etapa 1: Informações Básicas --}}
            <div id="step1" class="step">
                <div class="card mb-8">

                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">Registrar Nota Fiscal de Compra</h4>

                        <p class="badge bg-label-primary">Etapa 1</p>
                    </div>
                    <div class="card-body" id="step1Content">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="numeroNota" class="form-label toUpperCase">Número <span
                                        class="labelRequired">*</span></label>
                                <input
                                    type="number"
                                    name="numeroNota"
                                    id="numeroNota"
                                    class="form-control toUpperCase"
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
                                    class="form-control toUpperCase"
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
                                    class="form-control toUpperCase"
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
                                <label for="dataEmissao" class="form-label toUpperCase">Data Emissão <span
                                        class="labelRequired">*</span></label>
                                <input
                                    type="date"
                                    name="dataEmissao"
                                    id="dataEmissao"
                                    class="form-control toUpperCase"
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
                                    class="form-control toUpperCase"
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
                            <div class="d-flex align-items-center">
                                {{-- <a href="{{ route('purchase.index') }}"
                                    class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                                <button type="button" id="actionEtapa1"
                                    class="btn btn-primary toUpperCase">PROSSEGUIR</button> --}}
                                <button type="button"
                                    class="btn btn-primary toUpperCase" id="verificarCompra">Verificar nota</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-8 d-none">

                <div class="card-header d-flex justify-content-between">
                    <h5>Produtos</h5>
                    <p class="badge bg-label-primary">Etapa 2</p>
                </div>
                <div class="card-body ">
                    <span class="d-flex justify-content-center">
                        Para adicionar produtos, primeiro informe os dados da nota fiscal.
                    </span>
                </div>
            </div>

            {{-- Etapa 2: Produtos e Condições --}}
            <div id="step2" class="step">

                <div class="card mb-8">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Produtos</h5>

                        <p class="badge bg-label-primary">Etapa 2</p>
                    </div>
                    <div class="card-body" id="step2Content">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="row flex-grow-1">
                                <div class="col-md-6">
                                    <label class="form-label toUpperCase" for="product_id">Produto<span
                                            class="labelRequired">*</span></label>
                                    <div class="input-group">
                                        <select required name="product_id" class="form-select toUpperCase"
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
                                        <button class="btn btn-outline-secondary"
                                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                            type="button" data-bs-toggle="modal" data-bs-target="#supplierModal">
                                            <span class="tf-icons bx bx-search bx-18px"></span>
                                        </button>
                                        {{-- End Button --}}
                                    </div>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="qtdProduto" class="form-label toUpperCase">Quantidade <span
                                            class="labelRequired">*</span></label>
                                    <input type="number" name="qtdProduto" id="qtdProduto" placeholder="0"
                                        max="9999" min="0"
                                        oninput="limitInputLength(this, 4)" class="form-control toUpperCase">
                                </div>

                                <div class="col-md-2">
                                    <label for="precoProduto" class="form-label toUpperCase preco">Preço <span
                                            class="labelRequired">*</span></label>
                                    <input type="text" name="precoProduto" placeholder="R$ 00,00" maxlength="17"
                                        id="precoProduto"
                                        class="form-control preco toUpperCase" value="{{ old('preco') }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="descontoProduto" class="form-label toUpperCase">Desconto (%)</label>
                                    <input type="number" name="descontoProduto" placeholder="0" max="100"
                                        min="0"
                                        oninput="limitInputLength(this, 3)" id="descontoProduto"
                                        class="form-control desconto toUpperCase"
                                        value="{{ old('desconto') }}">
                                </div>

                            </div>
                            <div class="ms-6">
                                <button type="button" class="btn btn-outline-primary toUpperCase"
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
                            <div class="">
                                <h5>Frete</h5>
                                <div class="d-flex">
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label toUpperCase" for="tipoFrete">Tipo Frete<span
                                                class="labelRequired">*</span></label>
                                        <select required name="tipoFrete" class="form-select toUpperCase" id="tipoFrete">
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
                                            class="form-control preco toUpperCase"
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
                                            class="form-control preco toUpperCase"
                                            value="{{ old('valorSeguro') }}">
                                    </div>
                                    <div class="col-md-3 ms-4">
                                        <label for="outrasDepesas" class="form-label toUpperCase preco">Outras despesas
                                            <span class="labelRequired">*</span></label>
                                        <input
                                            type="text"
                                            name="outrasDepesas"
                                            placeholder="R$ 00,00"
                                            maxlength="17"
                                            id="outrasDepesas"
                                            class="form-control preco toUpperCase"
                                            value="{{ old('outrasDepesas') }}">
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
                                            name="totalProdutos"
                                            placeholder="R$ 00,00"
                                            maxlength="17"
                                            id="totalProdutos"
                                            class="form-control preco toUpperCase text-end"
                                            value="{{ old('totalProdutos') }}">
                                    </div>
                                    <div class="ms-4">
                                        <label for="totalPagar" class="form-label toUpperCase preco">valor da nota</label>
                                        <input
                                            disabled
                                            type="text"
                                            name="totalPagar"
                                            placeholder="R$ 00,00"
                                            maxlength="17"
                                            id="totalPagar"
                                            class="form-control preco toUpperCase text-end"
                                            value="{{ old('totalPagar') }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end mt-10">
                            <a href="{{ route('purchase.index') }}"
                                class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                            {{-- <button type="button" id="turnEtapa1"
                          class="btn btn-secondary toUpperCase me-4 ">Etapa
                          anterior</button> --}}

                            <!-- Botão que abre o modal de exclusão -->
                            <button
                                data-bs-toggle="modal"
                                data-bs-target="#turnStepConfirmation"
                                type="button"
                                class="btn btn-secondary toUpperCase me-4 ">Etapa
                                anterior</i>
                            </button>

                            <button type="button" id="actionEtapa2"
                                class="btn btn-primary toUpperCase">PROSSEGUIR</button>

                            <!-- Componente de modal de confirmação -->
                            @include('components.modalTurnStep', [
                                'objId' => 'step1',
                                'objNome' => 'Etapa 1',
                            ])
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-8 d-none">

                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0">Condição de Pagamento</h5>

                    <p class="badge bg-label-primary">Etapa 3</p>
                </div>
                <div class="card-body ">
                    <span class="d-flex justify-content-center">
                        Para definir a condição de pagamento, primeiro preencha as etapas 1 e 2.
                    </span>
                </div>
            </div>

            {{-- Etapa 3: Gerar Parcelas --}}
            <div id="step3" class="step">
                <div class="card mb-8">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Condição de Pagamento</h5>

                        <p class="badge bg-label-primary">Etapa 3</p>
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

                            <div class="ms-6">
                                <button type="button" class="btn btn-outline-primary toUpperCase"id="addParcela">Gerar
                                    Parcelas
                                </button>
                            </div>
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
                                class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                            {{-- <button type="button" id="turnEtapa2" class="btn btn-secondary toUpperCase me-4">Etapa
                                anterior</button> --}}
                            <button type="button" id="actionEtapa3" class="btn btn-success toUpperCase">cadastrar
                                nota</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        @include('content.product.modal.selectSupplier')

        {{-- Limita o tamanho dos campos --}}
        <script>
            function limitInputLength(input, length) {
                if (input.value.length > length) {
                    input.value = input.value.slice(0, length);
                }
            }
        </script>

        {{-- Busca dados do fornecedor --}}
        <script>
            $(document).ready(function() {
                $('#supplier_id').on('change', function() {
                    const supplierId = $(this).val(); // Captura o ID do fornecedor
                    const supplierDetailsBlock = $('.supplier-details-block');



                    // Chamada Axios para buscar detalhes
                    axios.get(`{{ route('supplier.findId', ':id') }}`.replace(':id',
                            supplierId)) // Substitui ':id' pelo supplierId
                        .then(response => {
                            console.log(response.data);
                            if (response.data.success) {
                                const supplier = response.data.supplier;
                                // Verifica o tipoPessoa e ajusta o título do documento
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
            });
        </script>

        {{-- Formata campos de preço --}}
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

        {{-- Verifica nota fiscal --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const verificarCompra = document.getElementById("verificarCompra");

                if (verificarCompra) {
                    verificarCompra.addEventListener("click", function(e) {
                        e.preventDefault();

                        // Captura os valores dos campos do formulário
                        const numeroNota = document.getElementById("numeroNota").value;
                        const modelo = document.getElementById("modelo").value;
                        const serie = document.getElementById("serie").value;
                        const supplier_id = document.getElementById("supplier_id").value;

                        // Valida os campos obrigatórios
                        if (!numeroNota || !modelo || !serie || !supplier_id) {
                            alert("Por favor, preencha todos os campos obrigatórios antes de prosseguir.");
                            return;
                        }

                        // Faz a requisição usando Axios
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
                                    alert("Fui e voltei");


                                    // Código se o fornecedor não foi cadastrado
                                    // toggleSteps(step1, step2); // Avança para a próxima etapa



                                }
                            })
                            .catch(error => {
                                console.error("Erro ao verificar nota fiscal:", error);
                                alert("Ocorreu um erro ao verificar a nota fiscal. Tente novamente.");
                            });
                    });
                }
            });
        </script>


        {{-- Adiciona produtos na listagem --}}
        <script>
            let produtosAdicionados = new Set(); // Conjunto para controlar produtos adicionados
            let valorTotalProdutos = 0;

            // Função para arredondar valores para 2 casas decimais
            function arredondar(valor) {
                return parseFloat(valor.toFixed(2));
            }

            // Função para formatar valores monetários no padrão brasileiro
            function formatarMoeda(valor) {
                return new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL',
                }).format(valor);
            }

            // Função para atualizar os valores totais
            function atualizarTotais() {
                $('#valorTotalProdutos').val(formatarMoeda(valorTotalProdutos)); // Atualiza o total dos produtos
                $('#totalProdutos').val(produtosAdicionados.size); // Atualiza a quantidade de produtos
                $('#totalPagar').val(formatarMoeda(valorTotalProdutos)); // Atualiza o total a pagar com máscara
            }

            $(document).ready(function() {
                // Adicionar produto
                $('#add-product').on('click', function() {
                    const product_id = $('#product_id').val();
                    const qtdProduto = parseInt($('#qtdProduto').val());
                    const precoProduto = parseFloat($('#precoProduto').val().replace('R$', '').replace(',', '.')
                        .trim());
                    const descontoProduto = parseFloat($('#descontoProduto').val() || 0);
                    const produtoNome = $('#product_id option:selected').data('nome');
                    const unidadeProduto = $('#product_id option:selected').data('medida');

                    // Validações
                    if (!product_id || !qtdProduto || isNaN(precoProduto)) {
                        return alert('Preencha todos os campos obrigatórios.');
                    }

                    if (descontoProduto > 100 || descontoProduto < 0) {
                        return alert('O desconto deve estar entre 0 e 100%.');
                    }

                    if (produtosAdicionados.has(product_id)) {
                        return alert('Este produto já foi adicionado.');
                    }

                    // Cálculos com arredondamento
                    const precoTotalProduto = arredondar(precoProduto * qtdProduto);
                    const valorDesconto = arredondar((descontoProduto / 100) * precoTotalProduto);
                    const precoTotal = arredondar(precoTotalProduto - valorDesconto);

                    // Atualiza o valor total dos produtos
                    valorTotalProdutos = arredondar(valorTotalProdutos + precoTotal);

                    // Adiciona o produto ao conjunto de IDs
                    produtosAdicionados.add(product_id);

                    // Adiciona a linha na tabela
                    $('#product-list').append(`
                      <tr class="product-item" data-id="${product_id}">
                          <td>${product_id}</td>
                          <td>${produtoNome}</td>
                          <td>${unidadeProduto}</td>
                          <td>${qtdProduto}</td>
                          <td>R$ ${precoProduto.toFixed(2).replace('.', ',')}</td>
                          <td>${descontoProduto} %</td>
                          <td>R$ ${precoTotal.toFixed(2).replace('.', ',')}</td>
                          <td class="size-col-action">
                              <button type="button" class="btn btn-outline-danger rounded-pill border-0 remove-product">
                                  <span class="tf-icons bx bx-trash bx-22px"></span>
                              </button>
                          </td>
                          <!-- Inputs escondidos para envio dos dados -->
                          <input type="hidden" name="produtos[${product_id}][product_id]" value="${product_id}">
                          <input type="hidden" name="produtos[${product_id}][produtoNome]" value="${produtoNome}">
                          <input type="hidden" name="produtos[${product_id}][unidadeProduto]" value="${unidadeProduto}">
                          <input type="hidden" name="produtos[${product_id}][qtdProduto]" value="${qtdProduto}">
                          <input type="hidden" name="produtos[${product_id}][precoProduto]" value="${precoProduto}">
                          <input type="hidden" name="produtos[${product_id}][descontoProduto]" value="${descontoProduto}">
                          <input type="hidden" name="produtos[${product_id}][precoTotal]" value="${precoTotal.toFixed(2)}">
                      </tr>
                  `);

                    // Atualiza os valores totais
                    atualizarTotais();

                    // Limpa os campos após adicionar o produto
                    $('#product_id').val('');
                    $('#qtdProduto').val('');
                    $('#precoProduto').val('');
                    $('#descontoProduto').val('');
                });

                // Remover produto
                $(document).on('click', '.remove-product', function() {
                    const row = $(this).closest('.product-item');
                    const product_id = row.data('id').toString(); // Garante que o ID seja uma string
                    const precoTotal = parseFloat(row.find('input[name$="[precoTotal]"]').val());

                    // Atualiza o valor total
                    valorTotalProdutos = arredondar(valorTotalProdutos - precoTotal);

                    // Remove o produto do conjunto
                    if (produtosAdicionados.has(product_id)) {
                        produtosAdicionados.delete(product_id);
                    } else {
                        console.warn(`Produto ${product_id} não encontrado no conjunto.`);
                    }

                    // Remove a linha da tabela
                    row.remove();

                    // Atualiza os valores totais
                    atualizarTotais();
                });

                // $('#valorFrete').on('change', function() {
                //     const valorFrete = $(this).val().replace('R$', '').replace(',', '.');

                //     atualizarTotais();
                //     valorTotalProdutos = arredondar(valorTotalProdutos + parseFloat(valorFrete));
                //     atualizarTotais();

                // });

                // $('#valorSeguro').on('change', function() {
                //     const supplierId = $(this).val(); // Captura o ID do fornecedor
                //     const supplierDetailsBlock = $('.supplier-details-block');
                // });

                // $('#outrasDespesas').on('change', function() {
                //     const supplierId = $(this).val(); // Captura o ID do fornecedor
                //     const supplierDetailsBlock = $('.supplier-details-block');
                // });
            });
        </script>






        {{-- <script>
        // Seletores das etapas
        const step1 = document.getElementById("step1");
        const step2 = document.getElementById("step2");
        const actionEtapa1 = document.getElementById("actionEtapa1");

        // Função para alternar entre as etapas
        function toggleSteps(currentStep, nextStep) {
            currentStep.classList.add("d-none");
            nextStep.classList.remove("d-none");
        }

        // Função do botão PROSSEGUIR na Etapa 1
        actionEtapa1.addEventListener("click", () => {
            // Captura os valores dos campos do formulário
            const numeroNota = document.getElementById("numeroNota").value;
            const modelo = document.getElementById("modelo").value;
            const serie = document.getElementById("serie").value;
            const supplier_id = document.getElementById("supplier_id").value;

            // Valida os campos obrigatórios
            if (!numeroNota || !modelo || !serie || !supplier_id) {
                alert(
                    "Por favor, preencha testeeeeeeeeeeeeeeeee 33333 todos os campos obrigatórios antes de prosseguir."
                );
                return;
            }

            // Faz a requisição usando Axios
            axios.post('/verificar-nota-fiscal', {
                    numeroNota: numeroNota,
                    modelo: modelo,
                    serie: serie,
                    supplier_id: supplier_id
                })
                .then(response => {
                    if (response.data.existe) {
                        alert("Esta nota fiscal já está cadastrada no sistema!");
                    } else {
                        toggleSteps(step1, step2); // Avança para a próxima etapa
                    }
                })
                .catch(error => {
                    console.error("Erro ao verificar nota fiscal:", error);
                    alert("Ocorreu um erro ao verificar a nota fiscal. Tente novamente.");
                });
        });
    </script> --}}

        {{-- <script>
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
    </script> --}}




    @endsection
