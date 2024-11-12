@extends('layouts/contentNavbarLayout')

@section('title', 'Alterar País')

@section('content')
    <div class="card mb-10">

        <div class="card-header d-flex justify-content-between">
            <h4>Alterar País</h4>

            <div>
                <span class="badge bg-label-secondary rounded-pill">Cadastro:
                    {{ date('d/m/Y H:i', strtotime($country->created_at)) }}
                </span>
                <span class="badge bg-label-secondary rounded-pill">Última alteração:
                    {{ $country->updated_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>


        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('country.update', $country->id) }}"
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
                        value="{{ old('id', $country->id) }}">
                </div>

                <div class="col-7">
                    <label
                        class="form-label toUpperCase"
                        for="nome">Nome do País</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control toUpperCase"
                        id="nome"
                        placeholder="Informe o nome do país"
                        maxlength="50"
                        value="{{ old('nome', $country->nome) }}">
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
                        placeholder="Informe a sigla do país"
                        maxlength="3"
                        value="{{ old('sigla', $country->sigla) }}">
                    @error('sigla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label
                        class="form-label toUpperCase"
                        for="ddi">DDI</label>
                    <input
                        required
                        name="ddi"
                        type="number"
                        class="form-control toUpperCase"
                        id="ddi"
                        placeholder="Informe o código DDI"
                        maxlength="5"
                        value="{{ old('ddi', $country->ddi) }}">
                    @error('ddi')
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
                            {{ $country->ativo ? 'checked' : '' }}>
                        <label class="form-check-label toUpperCase" for="defaultCheck1">Ativo</label>
                    </div>
                    <div>
                        <a href="{{ route('country.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button type="submit"
                            class="btn btn-success toUpperCase">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
