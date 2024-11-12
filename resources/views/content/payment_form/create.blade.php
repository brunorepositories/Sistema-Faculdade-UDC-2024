@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Forma de Pagamento')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar Forma de Pagamento</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('payment_form.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-12">
                    <label class="form-label toUpperCase" for="formaPagamento">Forma de Pagamento</label>
                    <input
                        required
                        name="formaPagamento"
                        type="text"
                        class="form-control toUpperCase"
                        id="formaPagamento"
                        placeholder="Informe a forma de pagamento"
                        maxlength="50"
                        value="{{ old('formaPagamento') }}">
                    @error('formaPagamento')
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
                        <a
                            href="{{ route('payment_form.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success toUpperCase">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
