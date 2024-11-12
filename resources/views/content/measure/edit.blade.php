@extends('layouts/contentNavbarLayout')

@section('title', 'Alterar Unidade de Medida')

@section('content')
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between">
            <h4>Alterar Unidade de Medida</h4>

            <div>
                <span class="badge bg-label-secondary rounded-pill">Cadastro:
                    {{ date('d/m/Y H:i', strtotime($measure->created_at)) }}
                </span>
                <span class="badge bg-label-secondary rounded-pill">Última alteração:
                    {{ $measure->updated_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('measure.update', $measure->id) }}"
                method="POST"
                novalidate="">

                @csrf
                @method('PUT') <!-- Usando PUT para a edição -->

                <div class="col-1">
                    <label
                        class="form-label toUpperCase"
                        for="id">Código</label>
                    <input
                        required
                        name="id"
                        class="form-control toUpperCase"
                        id="id"
                        disabled
                        value="{{ old('id', $measure->id) }}">
                </div>

                <div class="col-9">
                    <label
                        class="form-label toUpperCase"
                        for="nome">Nome da Medida</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control toUpperCase"
                        id="nome"
                        placeholder="Informe o nome da medida"
                        maxlength="50"
                        value="{{ old('nome', $measure->nome) }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label
                        class="form-label toUpperCase"
                        for="sigla">Sigla</label>
                    <input
                        required
                        name="sigla"
                        type="text"
                        class="form-control toUpperCase"
                        id="sigla"
                        placeholder="Informe a sigla da medida"
                        maxlength="5"
                        value="{{ old('sigla', $measure->sigla) }}">
                    @error('sigla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-10">
                    <div>
                        <input type="hidden" name="ativo" value="0">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="ativo"
                            id="defaultCheck1"
                            value="1"
                            {{ old('ativo', $measure->ativo) ? 'checked' : '' }}>
                        <label class="form-check-label toUpperCase" for="defaultCheck1">Ativo</label>
                    </div>
                    <div>
                        <a href="{{ route('measure.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button type="submit"
                            class="btn btn-success toUpperCase">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
