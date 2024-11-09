@extends('layouts/contentNavbarLayout')

@section('title', 'Nova cidade')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Nova cidade</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('city.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-8">
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
                        value="{{ old('nome') }}">
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
                        value="{{ old('ddd') }}">
                    @error('ddd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-3">
                    <label
                        class="form-label"
                        for="state_id">Estado</label>
                    <div class="input-group">
                        <select
                            required
                            name="state_id"
                            class="form-select"
                            id="state_id">
                            <option value="" disabled selected>Selecione o estado</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">
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
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="ativo"
                            id="defaultCheck1"
                            value="1"
                            disabled
                            checked>
                        <label class="form-check-label" for="defaultCheck1">Ativo</label>
                    </div>
                    <div>
                        <a href="{{ route('city.index') }}"
                            class="btn btn-outline-secondary me-4">Cancelar</a>
                        <button type="submit"
                            class="btn btn-success">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Selecionar pais + Cadastrar pais -->
    @include('content.city.modal.selectState')
@endsection
