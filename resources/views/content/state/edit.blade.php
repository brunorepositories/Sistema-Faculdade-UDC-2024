@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Estado')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Editar estado</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form id="stateEditForm" class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('state.update', $state->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="col-8">
                    <label
                        class="form-label"
                        for="nome">Nome do estado</label>
                    <input required
                        name="nome"
                        type="text"
                        class="form-control"
                        id="nome"
                        placeholder="Informe o nome do estado"
                        maxlength="50"
                        value="{{ Str::upper(old('nome', $state->nome)) }}">
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
                        value="{{ Str::upper(old('uf', $state->uf)) }}">
                    @error('uf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3">
                    <label class="form-label" for="country_id">País</label>
                    <div class="input-group">
                        <select
                            required
                            name="country_id"
                            class="form-select"
                            id="country_id">
                            <option value="" disabled>Selecione o país</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('country_id', $state->country_id) == $country->id ? 'selected' : '' }}>
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
                        <span class="badge bg-label-secondary rounded-pill">Cadastro:
                            {{ date('d/m/Y H:i', strtotime($state->created_at)) }}</span>
                        <span class="badge bg-label-secondary rounded-pill">Última alteração:
                            {{ date('d/m/Y H:i', strtotime($state->updated_at)) }}</span>
                    </div>
                    <div>

                        <a href="{{ route('state.index') }}"
                            class="btn btn-outline-secondary me-4">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Selecionar pais + Cadastrar pais -->
    @include('content.state.modal.selectCountry')
@endsection
