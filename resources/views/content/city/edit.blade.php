@extends('layouts/contentNavbarLayout')

@section('title', 'Alterar cidade')

@section('content')
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between">
            <h4>Alterar cidade</h4>

            <div>
                <span class="badge bg-label-secondary rounded-pill">Cadastro:
                    {{ date('d/m/Y H:i', strtotime($city->created_at)) }}
                </span>
                <span class="badge bg-label-secondary rounded-pill">Última alteração:
                    {{ $city->updated_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('city.update', $city->id) }}"
                method="POST"
                novalidate="">

                @csrf
                @method('PUT') <!-- Usando PUT para a edição -->

                <div class="col-1">
                    <label
                        class="form-label"
                        for="id">Código</label>
                    <input
                        required
                        name="id"
                        class="form-control"
                        id="id"
                        disabled
                        value="{{ old('id', $city->id) }}">
                </div>

                <div class="col-7">
                    <label
                        class="form-label"
                        for="nome">Nome da cidade</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control"
                        id="nome"
                        placeholder="Informe o nome da cidade"
                        maxlength="50"
                        value="{{ old('nome', $city->nome) }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-1">
                    <label
                        class="form-label"
                        for="ddd">DDD</label>
                    <input
                        required
                        name="ddd"
                        type="text"
                        class="form-control"
                        id="ddd"
                        placeholder="Informe o DDD"
                        maxlength="3"
                        value="{{ old('ddd', $city->ddd) }}">
                    @error('ddd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3">
                    <label class="form-label" for="state_id">País</label>
                    <div class="input-group">
                        <select
                            required
                            name="state_id"
                            class="form-select"
                            id="state_id">
                            <option value="" disabled>Selecione o país</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}"
                                    {{ old('state_id', $state->state_id) == $state->id ? 'selected' : '' }}>
                                    {{ $state->nome }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Botão de ação do modal de selecionar pais --}}
                        <button class="btn btn-outline-secondary"
                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#stateModal">
                            <span class="tf-icons bx bx-search bx-18px"></span>
                        </button>
                        {{-- End Button --}}

                    </div>
                    @error('state_id')
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
                            {{ old('ativo', $city->ativo) ? 'checked' : '' }}>
                        <label class="form-check-label" for="defaultCheck1">Ativo</label>
                    </div>
                    <div>
                        <a
                            href="{{ route('city.index') }}"
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
    @include('content.city.modal.selectState')
@endsection
