@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Unidade de Medida')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar Unidade de Medida</h4>

        <div class="card-body">
            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('measure.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-8">
                    <label class="form-label toUpperCase" for="nome">Nome da unidade de medida<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control toUpperCase"
                        id="nome"
                        placeholder="nome da unidade de medida"
                        maxlength="50"
                        value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-4">
                    <label class="form-label toUpperCase" for="sigla">Sigla<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="sigla"
                        type="text"
                        class="form-control toUpperCase"
                        id="sigla"
                        placeholder="sigla da unidade de medida"
                        maxlength="5"
                        value="{{ old('sigla') }}">
                    @error('sigla')
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
                        <a href="{{ route('measure.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button type="submit" class="btn btn-success toUpperCase">cadastrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
