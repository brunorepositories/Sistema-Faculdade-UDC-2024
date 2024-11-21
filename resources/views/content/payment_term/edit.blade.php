@extends('layouts/contentNavbarLayout')

@section('title', 'Alterar Condição de Pagamento')

@section('content')
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between">
            <h4>Alterar Condição de Pagamento</h4>

            <div>
                <span class="badge bg-label-secondary rounded-pill">Cadastro:
                    {{ date('d/m/Y H:i', strtotime($paymentTerm->created_at)) }}
                </span>
                <span class="badge bg-label-secondary rounded-pill">Última alteração:
                    {{ $paymentTerm->updated_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('payment_term.update', $paymentTerm->id) }}"
                method="POST"
                novalidate="">

                @csrf
                @method('PUT')

                <div class="col-1">
                    <label class="form-label toUpperCase" for="id">Código</label>
                    <input
                        required
                        name="id"
                        class="form-control"
                        id="id"
                        disabled
                        value="{{ old('id', $paymentTerm->id) }}">
                </div>

                <div class="col-5">
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
                        value="{{ old('condicaoPagamento', $paymentTerm->condicaoPagamento) }}">
                    @error('condicaoPagamento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label toUpperCase" for="multa">Multa (%)<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="multa"
                        type="number"
                        step="0,001"
                        class="form-control toUpperCase"
                        id="multa"
                        placeholder="0,00"
                        min="0"
                        value="{{ old('multa', $paymentTerm->multa) }}">
                    @error('multa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label toUpperCase" for="juros">Juros (%)<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="juros"
                        type="number"
                        step="0,001"
                        class="form-control toUpperCase"
                        id="juros"
                        min="0"
                        placeholder="0,00"
                        value="{{ old('juros', $paymentTerm->juros) }}">
                    @error('juros')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label class="form-label toUpperCase" for="desconto">Desconto (%)<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="desconto"
                        type="number"
                        step="0,001"
                        class="form-control toUpperCase"
                        id="desconto"
                        min="0"
                        placeholder="0,00"
                        value="{{ old('desconto', $paymentTerm->desconto) }}">
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
                                    placeholder="0">
                            </div>
                            <div class="col-2">
                                <label class="form-label toUpperCase" for="percentual">Percentual (%)</label>
                                <input
                                    type="number"
                                    class="form-control toUpperCase"
                                    id="percentual"
                                    min="0"
                                    max="100"
                                    placeholder="0,00">
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

                                    <button class="btn btn-outline-secondary"
                                        style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#paymentFormModal">
                                        <span class="tf-icons bx bx-search bx-18px"></span>
                                    </button>
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
                                    placeholder="0,00">
                            </div>
                        </div>

                        <div class="ms-6">
                            <button type="button" class="btn btn-primary" id="add-parcela">Adicionar</button>
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

                                {{-- {{ dd($paymentTerm->installments[0]->) }} --}}
                                <tbody id="parcelas-list" class="table-border">
                                    @foreach ($paymentTerm->installments as $index => $parcela)
                                        <tr class="parcela-item" data-index="{{ $index + 1 }}">
                                            <td>{{ $parcela->parcela }}</td>
                                            <td>{{ $parcela->dias }}</td>
                                            <td>{{ $parcela->percentual }}</td>
                                            <td>{{ $parcela->paymentForm->id }} -
                                                {{ $parcela->paymentForm->formaPagamento }}</td>
                                            <td class="size-col-action">
                                                <button type="button"
                                                    class="btn btn-outline-danger rounded-pill border-0 remove-parcela">
                                                    <span class="tf-icons bx bx-trash bx-22px"></span>
                                                </button>
                                            </td>
                                            <input type="hidden" name="parcelas[{{ $index + 1 }}][parcela]"
                                                value="{{ $parcela->parcela }}">
                                            <input type="hidden" name="parcelas[{{ $index + 1 }}][dias]"
                                                value="{{ $parcela->dias }}">
                                            <input type="hidden" name="parcelas[{{ $index + 1 }}][percentual]"
                                                value="{{ $parcela->percentual }}">
                                            <input type="hidden" name="parcelas[{{ $index + 1 }}][payment_form_id]"
                                                value="{{ $parcela->payment_form_id }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-10">
                    <div>
                        <input type="hidden" name="ativo" value="0">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="ativo"
                            id="ativo"
                            value="1"
                            {{ $paymentTerm->ativo ? 'checked' : '' }}>
                        <label class="form-check-label toUpperCase" for="ativo">Ativo</label>
                    </div>
                    <div>
                        <a
                            href="{{ route('payment_term.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success toUpperCase">Salvar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @include('content.payment_term.modal.selectPaymentForm')

    <script>
        let parcelaCount = {{ count($paymentTerm->installments) }};
        let percentualTotal = {{ $paymentTerm->installments->sum('percentual') }};

        $(document).ready(function() {
            // Atualiza o campo de percentual total inicialmente
            $('#percentualTotal').val(percentualTotal.toFixed(2));

            $('#add-parcela').on('click', function() {
                const parcela = $('#parcela').val();
                const diasParcela = $('#dias').val();
                const percentualParcela = $('#percentual').val();
                const payment_form_id = $('#payment_form_id').val();
                const formaPagamentoText = $('#payment_form_id option:selected').text();

                if (!parcela || !diasParcela || !percentualParcela || !payment_form_id) {
                    return alert(
                        'Por favor, preencha todos os campos antes de adicionar uma parcela.'
                    );
                }

                if (percentualTotal + parseFloat(percentualParcela) > 100) {
                    return alert(
                        'Percentual muito alto. A soma dos percentuais da parcela não pode ser maior que 100.'
                    );
                }

                parcelaCount++;
                percentualTotal += parseFloat(percentualParcela);

                $('#parcelas-list').append(` <tr class="parcela-item" data-index="${parcelaCount}">
                                        <td>${parcela}</td>
                                        <td>${diasParcela}</td>
                                        <td>${percentualParcela}</td>
                                        <td>${formaPagamentoText}</td>
                                        <td class="size-col-action">
                                            <button type="button" class="btn btn-outline-danger rounded-pill border-0 remove-parcela">
                                                <span class="tf-icons bx bx-trash bx-22px"></span>
                                            </button>
                                        </td>
                                        <input type="hidden" name="parcelas[${parcelaCount}][parcela]" value="${parcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][dias]" value="${diasParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][percentual]" value="${percentualParcela}">
                                        <input type="hidden" name="parcelas[${parcelaCount}][payment_form_id]" value="${payment_form_id}">
                                    </tr> `);

                $('#parcela').val('');
                $('#dias').val('');
                $('#percentual').val('');
                $('#payment_form_id').val('');

                $('#percentualTotal').val(percentualTotal.toFixed(2));

                reorderParcelas();
            });

            $(document).on('click', '.remove-parcela', function() {
                parcelaCount--;

                const percentualParcela = parseFloat($(this).closest('.parcela-item').find('td:eq(2)')
                    .text());

                percentualTotal -= percentualParcela;

                $('#percentualTotal').val(percentualTotal.toFixed(2));

                $(this).closest('.parcela-item').remove();

                reorderParcelas();
            });

            function reorderParcelas() {
                const rows = $('#parcelas-list .parcela-item').get();

                rows.sort((a, b) => {
                    const numA = parseInt($(a).find('td:eq(0)').text());
                    const numB = parseInt($(b).find('td:eq(0)').text());
                    return numA - numB;
                });

                $('#parcelas-list').empty().append(rows);
            }
        });
    </script>


@endsection
