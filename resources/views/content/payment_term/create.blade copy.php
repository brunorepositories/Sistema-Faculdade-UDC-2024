@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Condição de Pagamento')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Nova Condição de Pagamento</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation @if ($errors->any()) was-validated @endif"
                action="{{ route('payment_term.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="row">
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
                        <label class="form-label" for="multa">Multa</label>
                        <input
                            required
                            name="multa"
                            type="number"
                            step="0.01"
                            class="form-control"
                            id="multa"
                            placeholder="Informe a multa"
                            value="{{ old('multa') }}">
                        @error('multa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-2">
                        <label class="form-label" for="juros">Juros</label>
                        <input
                            required
                            name="juros"
                            type="number"
                            step="0.01"
                            min="0"
                            class="form-control"
                            id="juros"
                            placeholder="Informe o juros"
                            value="{{ old('juros') }}">
                        @error('juros')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-2">
                        <label class="form-label" for="desconto">Desconto</label>
                        <input
                            required
                            name="desconto"
                            type="number"
                            step="0.01"
                            class="form-control"
                            id="desconto"
                            placeholder="Informe o desconto"
                            value="{{ old('desconto') }}">
                        @error('desconto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-4 d-flex align-items-end">
                    <div class="col-1">
                        <label class="form-label" for="numParcela">Nº Parcela</label>
                        <input
                            required
                            name="numParcela"
                            type="text"
                            class="form-control"
                            id="numParcela"
                            placeholder="Informe a condição de pagamento"
                            maxlength="50"
                            value="{{ old('numParcela') }}">
                        @error('numParcela')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-2">
                        <label class="form-label" for="dias">Multa</label>
                        <input
                            required
                            name="dias"
                            type="number"
                            step="0.01"
                            class="form-control"
                            id="dias"
                            placeholder="Informe a dias"
                            value="{{ old('dias') }}">
                        @error('dias')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-2">
                        <label class="form-label" for="percentual">Juro</label>
                        <input
                            required
                            name="percentual"
                            type="number"
                            step="0.01"
                            class="form-control"
                            id="percentual"
                            placeholder="Informe o percentual"
                            value="{{ old('percentual') }}">
                        @error('percentual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-2">
                        <label class="form-label" for="desconto">Desconto</label>
                        <input
                            required
                            name="desconto"
                            type="number"
                            step="0.01"
                            class="form-control"
                            id="desconto"
                            placeholder="Informe o desconto"
                            value="{{ old('desconto') }}">
                        @error('desconto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label
                            class="form-label"
                            for="payment_form_id">Forma de Pagamento</label>
                        <div class="input-group">
                            <select
                                required
                                name="payment_form_id"
                                class="form-select"
                                id="payment_form_id">
                                <option value="" disabled selected>Selecione a forma de pagamento</option>
                                @foreach ($paymentForms as $paymentForm)
                                    <option value="{{ $paymentForm->id }}">
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

                    <div class="col-1">
                        <button class="btn btn-primary">Adicionar</button>
                    </div>
                </div>

                {{-- <div class="col-4">
                    <label class="form-label" for="qtdParcelas">Quantidade de Parcelas</label>
                    <input
                        required
                        name="qtdParcelas"
                        type="number"
                        class="form-control"
                        id="qtdParcelas"
                        placeholder="Informe a quantidade de parcelas"
                        value="{{ old('qtdParcelas') }}">
                    @error('qtdParcelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}




                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Selecionar Medida -->
    @include('content.payment_term.modal.selectPaymentForm')
@endsection
