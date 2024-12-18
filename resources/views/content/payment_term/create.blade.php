@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Condição de Pagamento')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar Condição de Pagamento</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('payment_term.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-6">
                    <label class="form-label toUpperCase" for="condicaoPagamento">Condição de Pagamento<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="condicaoPagamento"
                        type="text"
                        class="form-control toUpperCase"
                        id="condicaoPagamento"
                        placeholder="Informe a condição de pagamento"
                        maxlength="50"
                        value="{{ old('condicaoPagamento') }}">
                    @error('condicaoPagamento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label toUpperCase" for="multa">Multa (%)</label>
                    <input
                        name="multa"
                        type="number"
                        class="form-control toUpperCase"
                        id="multa"
                        min="0"
                        max="100"
                        oninput="limitInputLength(this, 5)"
                        placeholder="0"
                        value="{{ old('multa') }}">
                    @error('multa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label toUpperCase" for="juros">Juros (%)</label>
                    <input
                        class="form-control toUpperCase"
                        id="juros"
                        name="juros"
                        type="number"
                        min="0"
                        max="100"
                        oninput="limitInputLength(this, 5)"
                        placeholder="0"
                        value="{{ old('juros') }}">
                    @error('juros')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label toUpperCase" for="desconto">Desconto (%)</label>
                    <input
                        name="desconto"
                        class="form-control toUpperCase"
                        id="desconto"
                        type="number"
                        min="0"
                        max="100"
                        oninput="limitInputLength(this, 5)"
                        placeholder="0"
                        value="{{ old('desconto') }}">
                    @error('desconto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-8">
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="row flex-grow-1">
                            <div class="col-2">
                                <label class="form-label toUpperCase" for="parcela">Parcela</label>
                                <input
                                    type="number"
                                    class="form-control toUpperCase"
                                    id="parcela"
                                    oninput="limitInputLength(this, 3)"
                                    min="0"
                                    placeholder="0">
                            </div>
                            <div class="col-2">
                                <label class="form-label toUpperCase" for="dias">Dias (corridos)</label>
                                <input
                                    type="number"
                                    class="form-control toUpperCase"
                                    id="dias"
                                    min="0"
                                    oninput="limitInputLength(this, 3)"
                                    placeholder="0">
                            </div>
                            <div class="col-2">
                                <label class="form-label toUpperCase" for="percentual">Percentual (%)</label>
                                <input
                                    class="form-control toUpperCase"
                                    id="percentual"
                                    type="number"
                                    min="0"
                                    max="100"
                                    oninput="limitInputLength(this, 5)"
                                    placeholder="0">
                            </div>
                            <div class="col flex-grow-1">
                                <label class="form-label toUpperCase" for="payment_form_id">Forma de Pagamento</label>
                                <div class="input-group">
                                    <select
                                        name="payment_form_id"
                                        class="form-select"
                                        id="payment_form_id">
                                        <option value="" disabled selected>Selecione</option>
                                        @foreach ($paymentForms as $paymentForm)
                                            <option value="{{ $paymentForm->id }}">
                                                {{ $paymentForm->id }} -
                                                {{ $paymentForm->formaPagamento }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Botão de ação do modal de selecionar forma de pagamento --}}
                                    <button class="btn btn-outline-secondary"
                                        style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#paymentFormModal">
                                        <span class="tf-icons bx bx-search bx-18px"></span>
                                    </button>
                                    {{-- End Button --}}
                                </div>


                                @error('payment_form_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-2">
                                <label class="form-label toUpperCase" for="percentualTotal">Percentual total (%)</label>
                                <input
                                    disabled
                                    type="number"
                                    class="form-control toUpperCase"
                                    id="percentualTotal"
                                    placeholder="0">
                            </div>
                        </div>

                        <div class="ms-6">
                            <button type="button" class="btn btn-outline-primary toUpperCase"
                                id="add-parcela">Adicionar</button>
                        </div>

                        @error('percentualTotal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="parcelas-container" class="mt-3">
                        <div class="table-responsive text-nowrap">

                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nº Parcela</th>
                                        <th>Dias</th>
                                        <th>Percentual (%)</th>
                                        <th>Forma de pagamento</th>
                                        <th class="centered-text size-col-action">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="parcelas-list" class="table-border"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-10">

                    <div class="d-flex">
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
                        <div class="ms-4">
                            <input type="hidden" name="padrao" value="0">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="padrao"
                                id="padrao"
                                value="1">
                            <label class="form-check-label toUpperCase" for="padrao">Condição padrão</label>
                        </div>
                    </div>
                    <div>
                        <a
                            href="{{ route('payment_term.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success toUpperCase">Cadastrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!-- Modal Selecionar Medida -->
    @include('content.payment_term.modal.selectPaymentForm')

    <script>
        let parcelaCount = 0;
        let percentualTotal = 0;

        // Limita o tamanho dos campos
        function limitInputLength(input, length) {
            if (input.value.length > length) {
                input.value = input.value.slice(0, length);
            }
        }

        $(document).ready(function() {
            // Reconstrói as parcelas do old() se existirem
            const oldParcelas = {!! json_encode(old('parcelas', [])) !!};

            if (Object.keys(oldParcelas).length > 0) {
                Object.keys(oldParcelas).forEach(index => {
                    const parcela = oldParcelas[index];

                    // Incrementa o contador e adiciona ao percentual total
                    parcelaCount++;
                    percentualTotal += parseFloat(parcela.percentual);

                    // Busca o texto da forma de pagamento
                    const formaPagamentoText = $(
                        `#payment_form_id option[value='${parcela.payment_form_id}']`).text();

                    // Adiciona a linha na tabela
                    $('#parcelas-list').append(`
                      <tr class="parcela-item" data-index="${index}">
                          <td>${parcela.parcela}</td>
                          <td>${parcela.dias}</td>
                          <td>${parcela.percentual}</td>
                          <td>${formaPagamentoText}</td>
                          <td class="size-col-action">
                              <button type="button" class="btn btn-outline-danger rounded-pill border-0 remove-parcela">
                                  <span class="tf-icons bx bx-trash bx-22px"></span>
                              </button>
                          </td>
                          <input type="hidden" name="parcelas[${index}][parcela]" value="${parcela.parcela}">
                          <input type="hidden" name="parcelas[${index}][dias]" value="${parcela.dias}">
                          <input type="hidden" name="parcelas[${index}][percentual]" value="${parcela.percentual}">
                          <input type="hidden" name="parcelas[${index}][payment_form_id]" value="${parcela.payment_form_id}">
                      </tr>
                  `);
                });

                // Atualiza o campo de percentual total
                $('#percentualTotal').val(percentualTotal.toFixed(2));

                // Reordena as parcelas
                reorderParcelas();
            }

            // Adiciona validação no envio do formulário
            $('form').on('submit', function(e) {
                // Verifica se o percentual total é diferente de 100
                if (percentualTotal !== 100) {
                    e.preventDefault(); // Impede o envio do formulário
                    alert(
                        'O campo percentual total (%) deve ser igual a 100. Adicione parcelas para completar.');
                    return false;
                }
                return true;
            });

            $('#add-parcela').on('click', function() {
                // Recupera os valores dos campos
                const numParcela = $('#parcela').val();
                const diasParcela = $('#dias').val();
                const percentualParcela = $('#percentual').val();
                const payment_form_id = $('#payment_form_id').val();
                const formaPagamentoText = $('#payment_form_id option:selected').text();

                // Valida se todos os campos estão preenchidos
                if (!numParcela || !diasParcela || !percentualParcela || !payment_form_id) {
                    return alert('Por favor, preencha todos os campos antes de adicionar uma parcela.');
                }

                if (percentualTotal + parseFloat(percentualParcela) > 100) {
                    return alert(
                        'Percentual muito alto. A soma dos percentuais da parcela não pode ser maior que 100.'
                        );
                }

                // Incrementa o contador de parcelas e o percentual total
                parcelaCount++;
                percentualTotal += parseFloat(percentualParcela);

                // Adiciona a nova linha na tabela com os dados da parcela
                $('#parcelas-list').append(`
                  <tr class="parcela-item" data-index="${parcelaCount}">
                      <td>${numParcela}</td>
                      <td>${diasParcela}</td>
                      <td>${percentualParcela}</td>
                      <td>${formaPagamentoText}</td>
                      <td class="size-col-action">
                          <button type="button" class="btn btn-outline-danger rounded-pill border-0 remove-parcela">
                              <span class="tf-icons bx bx-trash bx-22px"></span>
                          </button>
                      </td>
                      <input type="hidden" name="parcelas[${parcelaCount}][parcela]" value="${numParcela}">
                      <input type="hidden" name="parcelas[${parcelaCount}][dias]" value="${diasParcela}">
                      <input type="hidden" name="parcelas[${parcelaCount}][percentual]" value="${percentualParcela}">
                      <input type="hidden" name="parcelas[${parcelaCount}][payment_form_id]" value="${payment_form_id}">
                  </tr>
              `);

                // Limpar os campos após adicionar a parcela
                $('#parcela').val('');
                $('#dias').val('');
                $('#percentual').val('');
                $('#payment_form_id').val('');

                // Atualiza o percentual total
                $('#percentualTotal').val(percentualTotal.toFixed(2));

                // Reordena as parcelas
                reorderParcelas();
            });

            $(document).on('click', '.remove-parcela', function() {
                // Captura o valor percentual da parcela que será removida
                const percentualParcela = parseFloat($(this).closest('.parcela-item').find('td:eq(2)')
                .text());

                // Diminui o contador de parcelas
                parcelaCount--;

                // Subtrai o percentual da parcela do total
                percentualTotal -= percentualParcela;

                // Atualiza o valor do percentual total no campo
                $('#percentualTotal').val(percentualTotal.toFixed(2));

                // Remove a linha da tabela
                $(this).closest('.parcela-item').remove();

                // Reordena as parcelas após a remoção
                reorderParcelas();
            });

            // Validações dos campos de percentual
            $('#desconto, #multa, #juros, #percentual').on('change', function() {
                const campo = $(this);
                const valor = parseFloat(campo.val() || 0);
                const nomeCampo = campo.prev('label').text().toLowerCase();

                if (valor > 100 || valor < 0) {
                    campo.val('');
                    alert(`O ${nomeCampo} deve estar entre 0 e 100%.`);
                }
            });

            function reorderParcelas() {
                const rows = $('#parcelas-list .parcela-item').get();

                // Ordena as linhas com base no número da parcela
                rows.sort((a, b) => {
                    const numA = parseInt($(a).find('td:eq(0)').text());
                    const numB = parseInt($(b).find('td:eq(0)').text());
                    return numA - numB;
                });

                // Remove todas as linhas e adiciona na ordem correta
                $('#parcelas-list').empty().append(rows);
            }
        });
    </script>

    {{-- <script>
        let parcelaCount = 0;
        let percentualTotal = 0;

        // Limita o tamanho dos campos
        function limitInputLength(input, length) {
            if (input.value.length > length) {
                input.value = input.value.slice(0, length);
            }
        }

        $(document).ready(function() {

            // Adiciona validação no envio do formulário
            $('form').on('submit', function(e) {
                // Verifica se o percentual total é diferente de 100
                if (percentualTotal !== 100) {
                    e.preventDefault(); // Impede o envio do formulário
                    alert(
                        'O campo percentual total (%) deve ser igual a 100. Adicione parcelas para completar.'
                    );
                    return false;
                }
                return true;
            });

            $('#add-parcela').on('click', function() {

                // Recupera os valores dos campos
                const numParcela = $('#parcela').val();
                const diasParcela = $('#dias').val();
                const percentualParcela = $('#percentual').val();
                const payment_form_id = $('#payment_form_id').val();
                const formaPagamentoText = $('#payment_form_id option:selected').text();

                // Valida se todos os campos estão preenchidos
                if (!numParcela || !diasParcela || !percentualParcela || !payment_form_id) {
                    return alert(
                        'Por favor, preencha todos os campos antes de adicionar uma parcela.'
                    );
                }

                if (percentualTotal + parseFloat(percentualParcela) > 100) {
                    return alert(
                        'Percentual muito alto. A soma dos percentuais da parcela não pode ser maior que 100.'
                    );
                }

                // Incrementa o contador de parcelas e o percentual total
                parcelaCount++;
                percentualTotal += parseFloat(percentualParcela);

                // Adiciona a nova linha na tabela com os dados da parcela
                $('#parcelas-list').append(` <tr class="parcela-item" data-index="${parcelaCount}">
                                        <td>${numParcela}</td>
                                        <td>${diasParcela}</td>
                                        <td>${percentualParcela}</td>
                                        <td>${formaPagamentoText}</td>
                                        <td class="size-col-action">
                                            <button type="button" class="btn btn-outline-danger rounded-pill border-0 remove-parcela">
                                                <span class="tf-icons bx bx-trash bx-22px"></span>
                                            </button>
                                        </td>
                                        <input type="hidden" name="parcelas[${parcelaCount}][parcela]" value="${numParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][dias]" value="${diasParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][percentual]" value="${percentualParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][payment_form_id]" value="${payment_form_id}">
                                    </tr> `);

                // Limpar os campos após adicionar a parcela
                $('#parcela').val('');
                $('#dias').val('');
                $('#percentual').val('');
                $('#payment_form_id').val('');

                // Atualiza o percentual total
                $('#percentualTotal').val(percentualTotal.toFixed(2));

                // Reordena as parcelas
                reorderParcelas();
            });

            $(document).on('click', '.remove-parcela', function() {
                // Diminui o contador de parcelas
                parcelaCount--;

                // Captura o valor percentual da parcela que será removida
                const percentualParcela = parseFloat($(this).closest('.parcela-item').find('td:eq(2)')
                    .text());

                // Subtrai o percentual da parcela do total
                percentualTotal -= percentualParcela;

                // Atualiza o valor do percentual total no campo
                $('#percentualTotal').val(percentualTotal.toFixed(2));

                // Remove a linha da tabela
                $(this).closest('.parcela-item').remove();

                // Reordena as parcelas após a remoção
                reorderParcelas();
            });

            $('#desconto').on('change', function() {
                const desconto = parseFloat($('#desconto').val() || 0);

                if (desconto > 100 || desconto < 0) {
                    $('#desconto').val('');
                    return alert('O desconto deve estar entre 0 e 100%.');
                }
            });

            $('#multa').on('change', function() {
                const multa = parseFloat($('#multa').val() || 0);

                if (multa > 100 || multa < 0) {
                    $('#multa').val('');
                    return alert('A multa deve estar entre 0 e 100%.');
                }
            });

            $('#juros').on('change', function() {
                const juros = parseFloat($('#juros').val() || 0);

                if (juros > 100 || juros < 0) {
                    $('#juros').val('');
                    return alert('O juros deve estar entre 0 e 100%.');
                }

            });

            $('#percentual').on('change', function() {
                const percentual = parseFloat($('#percentual').val() || 0);

                if (percentual > 100 || percentual < 0) {
                    $('#percentual').val('');
                    return alert('O percentual deve estar entre 0 e 100%.');
                }

            });

            function reorderParcelas() {
                const rows = $('#parcelas-list .parcela-item').get();

                // Ordena as linhas com base no número da parcela (assumindo que está na primeira coluna)
                rows.sort((a, b) => {
                    const numA = parseInt($(a).find('td:eq(0)').text());
                    const numB = parseInt($(b).find('td:eq(0)').text());
                    return numA - numB; // Ordem crescente
                });

                // Remove todas as linhas e adiciona na ordem correta
                $('#parcelas-list').empty().append(rows);
            }
        });
    </script> --}}


@endsection
