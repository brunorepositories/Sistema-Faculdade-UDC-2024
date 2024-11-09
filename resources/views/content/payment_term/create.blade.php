@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Condição de Pagamento')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Nova Condição de Pagamento</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('payment_term.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-6">
                    <label class="form-label" for="condicaoPagamento">Condição de Pagamento</label>
                    <input
                        required
                        name="condicaoPagamento"
                        type="text"
                        class="form-control"
                        id="condicaoPagamento"
                        placeholder="Informe a condição de pagamento"
                        maxlength="50"
                        value="{{ old('condicaoPagamento') }}">
                    @error('condicaoPagamento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label" for="multa">Multa (%)</label>
                    <input
                        required
                        name="multa"
                        type="number"
                        step="0,001"
                        class="form-control"
                        id="multa"
                        placeholder="0,00"
                        min="0"
                        value="{{ old('multa') }}">
                    @error('multa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label" for="juros">Juros (%)</label>
                    <input
                        required
                        name="juros"
                        type="number"
                        step="0,001"
                        class="form-control"
                        id="juros"
                        min="0"
                        placeholder="0,00"
                        value="{{ old('juros') }}">
                    @error('juros')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label" for="desconto">Desconto (%)</label>
                    <input
                        required
                        name="desconto"
                        type="number"
                        step="0,001"
                        class="form-control"
                        id="desconto"
                        min="0"
                        placeholder="0,00"
                        value="{{ old('desconto') }}">
                    @error('desconto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-8">
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="row flex-grow-1">
                            <div class="col-2">
                                <label class="form-label" for="num">Parcela</label>
                                <input
                                    required
                                    type="number"
                                    class="form-control"
                                    id="num"
                                    min="0"
                                    placeholder="0">
                            </div>
                            <div class="col-2">
                                <label class="form-label" for="dias">Dias (corridos)</label>
                                <input
                                    required
                                    type="number"
                                    class="form-control"
                                    id="dias"
                                    min="0"
                                    placeholder="0">
                            </div>
                            <div class="col-2">
                                <label class="form-label" for="percentual">Percentual (%)</label>
                                <input
                                    required
                                    type="number"
                                    class="form-control"
                                    id="percentual"
                                    min="0"
                                    max="100"
                                    placeholder="0,00">
                            </div>
                            <div class="col-2">
                                <label class="form-label" for="percentualTotal">Percentual total (%)</label>
                                <input
                                    disabled
                                    type="number"
                                    class="form-control"
                                    id="percentualTotal"
                                    placeholder="0,00">
                            </div>
                            <div class="col flex-grow-1">
                                <label class="form-label" for="payment_form_id">Forma de Pagamento</label>
                                <div class="input-group">
                                    <select
                                        required
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
                        </div>

                        <div class="ms-6">
                            <button type="button" class="btn btn-primary" id="add-parcela">Adicionar</button>
                        </div>
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
                    <div>
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="ativo"
                            id="ativo"
                            value="1"
                            disabled
                            checked>
                        <label class="form-check-label" for="ativo">Ativo</label>
                    </div>
                    <div>
                        <a
                            href="{{ route('payment_term.index') }}"
                            class="btn btn-outline-secondary me-4">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success">Cadastrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!-- Modal Selecionar Medida -->
    @include('content.payment_term.modal.selectPaymentForm')
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let parcelaCount = 0;
    let percentualTotal = 0;

    $(document).ready(function() {
        $('#add-parcela').on('click', function() {

            // Recupera os valores dos campos
            const numParcela = $('#num').val();
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
                                        <input type="hidden" name="parcelas[${parcelaCount}][num]" value="${numParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][dias]" value="${diasParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][percentual]" value="${percentualParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][payment_form_id]" value="${payment_form_id}">
                                    </tr> `);

            // Limpar os campos após adicionar a parcela
            $('#num').val('');
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
</script>
