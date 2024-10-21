@extends('layouts/contentNavbarLayout')

@section('title', 'Alterar Medida')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Alterar Medida</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('measure.update', $measure->id) }}"
                method="POST"
                novalidate="">

                @csrf
                @method('PUT') <!-- Usando PUT para a edição -->

                <div class="col-10">
                    <label
                        class="form-label"
                        for="nome">Nome da Medida</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control"
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
                        class="form-label"
                        for="sigla">Sigla</label>
                    <input
                        required
                        name="sigla"
                        type="text"
                        class="form-control"
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
                        <span class="badge bg-label-secondary rounded-pill">Cadastro:
                            {{ date('d/m/Y H:i', strtotime($measure->created_at)) }}</span>
                        <span class="badge bg-label-secondary rounded-pill">Última alteração:
                            {{ $measure->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div>
                        <a href="{{ route('measure.index') }}"
                            class="btn btn-outline-secondary me-4">Cancelar</a>
                        <button type="submit"
                            class="btn btn-success">Salvar</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
