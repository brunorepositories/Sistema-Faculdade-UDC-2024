@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Estado')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar Estado</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('state.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-8">
                    <label
                        class="form-label"
                        for="nome">Nome do Estado</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control"
                        id="nome"
                        placeholder="Informe o nome do estado"
                        maxlength="50"
                        value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-1">
                    <label
                        class="form-label"
                        for="uf">UF</label>
                    <input
                        required
                        name="uf"
                        type="text"
                        class="form-control"
                        id="uf"
                        placeholder="Informe a sigla UF"
                        maxlength="2"
                        value="{{ old('uf') }}">
                    @error('uf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3">
                    <label
                        class="form-label"
                        for="country_id">País</label>
                    <select
                        required
                        name="country_id"
                        class="form-control"
                        id="country_id">
                        <option value="" disabled selected>Selecione o país</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                {{ $country->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-10">
                    <a
                        href="{{ route('state.index') }}"
                        class="btn btn-outline-primary me-4">Cancelar</a>
                    <button
                        type="submit"
                        class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
