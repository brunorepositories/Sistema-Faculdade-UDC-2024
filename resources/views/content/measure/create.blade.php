@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Medida')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Nova Medida</h4>

        <div class="card-body">
            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('measure.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-7">
                    <label class="form-label" for="nome">Nome da medida</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control"
                        id="nome"
                        placeholder="Informe o nome da medida"
                        maxlength="50"
                        value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-5">
                    <label class="form-label" for="sigla">Sigla</label>
                    <input
                        required
                        name="sigla"
                        type="text"
                        class="form-control"
                        id="sigla"
                        placeholder="Informe a sigla da medida"
                        maxlength="5"
                        value="{{ old('sigla') }}">
                    @error('sigla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                        <a href="{{ route('measure.index') }}" class="btn btn-outline-secondary me-4">Cancelar</a>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
