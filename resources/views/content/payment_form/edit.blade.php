@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Forma de Pagamento')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Editar Forma de Pagamento</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('payment_form.update', $paymentForm->id) }}"
                method="POST"
                novalidate="">

                @csrf
                @method('PUT')

                <div class="col-12">
                    <label class="form-label" for="formaPagamento">Forma de Pagamento</label>
                    <input
                        required
                        name="formaPagamento"
                        type="text"
                        class="form-control"
                        id="formaPagamento"
                        placeholder="Informe a forma de pagamento"
                        maxlength="50"
                        value="{{ old('formaPagamento', $paymentForm->formaPagamento) }}">
                    @error('formaPagamento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-10">
                    <a
                        href="{{ route('payment_form.index') }}"
                        class="btn btn-outline-secondary me-4">Cancelar</a>
                    <button
                        type="submit"
                        class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
