@extends('layouts/contentNavbarLayout')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Cadastrar País')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar País</h4>

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
                        class="form-label toUpperCase"
                        for="nome">Nome do país <span class="labelRequired">*</span></label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control toUpperCase"
                        id="nome"
                        placeholder="Nome do país"
                        maxlength="50"
                        value="{{ Str::upper(old('nome')) }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label
                        class="form-label toUpperCase"
                        for="sigla">Sigla<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="sigla"
                        type="text"
                        class="form-control toUpperCase"
                        id="sigla"
                        placeholder="sigla"
                        maxlength="3"
                        value="{{ old('sigla') }}">
                    @error('sigla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label
                        class="form-label toUpperCase"
                        for="ddi">DDI<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="ddi"
                        type="number"
                        class="form-control"
                        id="ddi"
                        placeholder="código DDI"
                        maxlength="3"
                        value="{{ old('ddi') }}">
                    @error('ddi')
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
                            disabled
                            checked>
                        <label class="form-label form-check-label toUpperCase" for="ativo">Ativo</label>
                    </div>
                    <div>
                        <a href="{{ route('country.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button type="submit"
                            class="btn btn-success toUpperCase">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
