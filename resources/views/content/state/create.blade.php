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
                        class="form-label toUpperCase"
                        for="nome">Nome do estado</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control toUpperCase"
                        id="nome"
                        placeholder="Nome do estado"
                        maxlength="50"
                        value="{{ Str::upper(old('nome')) }}">
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
                        class="form-control toUpperCase"
                        id="uf"
                        placeholder="Sigla"
                        maxlength="2"
                        value="{{ Str::upper(old('uf')) }}">
                    @error('uf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3">
                    <label class="form-label toUpperCase" for="country_id">País</label>
                    <div class="input-group">
                        <select
                            required
                            name="country_id"
                            class="form-select toUpperCase"
                            id="country_id">
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">
                                    {{ $country->nome }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Botão de ação do modal de selecionar pais --}}
                        <button class="btn btn-outline-secondary"
                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#countryModal">
                            <span class="tf-icons bx bx-search bx-18px"></span>
                        </button>
                        {{-- End Button --}}

                    </div>
                    @error('country_id')
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
                            href="{{ route('state.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success toUpperCase">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Selecionar pais + Cadastrar pais -->
    @include('content.state.modal.selectCountry')
@endsection
