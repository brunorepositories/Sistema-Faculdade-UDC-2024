@extends('layouts/contentNavbarLayout')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Novo país')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Novo país</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('country.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-8">
                    <label
                        class="form-label"
                        for="nome">Nome do país</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control toUpperCase"
                        id="nome"
                        placeholder="Informe o nome do país"
                        maxlength="50"
                        value="{{ Str::upper(old('nome')) }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label
                        class="form-label"
                        for="sigla">Sigla</label>
                    <input
                        required
                        name="sigla"
                        type="text"
                        class="form-control toUpperCase"
                        id="sigla"
                        placeholder="Informe a sigla do país"
                        maxlength="3"
                        value="{{ old('sigla') }}">
                    @error('sigla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label
                        class="form-label"
                        for="ddi">DDI</label>
                    <input
                        required
                        name="ddi"
                        type="number"
                        class="form-control"
                        id="ddi"
                        placeholder="Informe o código DDI"
                        maxlength="3"
                        value="{{ old('ddi') }}">
                    @error('ddi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-10">
                    <a
                        href="{{ route('country.index') }}"
                        class="btn btn-outline-secondary me-4">Cancelar</a>
                    <button
                        type="submit"
                        class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
