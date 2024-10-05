@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Cidade')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Editar cidade</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('city.update', $city->id) }}"
                method="POST"
                novalidate="">

                @csrf
                @method('PUT') <!-- Usando PUT para a edição -->

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
                    <label
                        class="form-label"
                        for="state_id">Estado</label>
                    <select
                        required
                        name="state_id"
                        class="form-control"
                        id="state_id">
                        <option value="" disabled>Selecione o estado</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('state_id', $city->state_id) == $state->id ? 'selected' : '' }}>
                                {{ $state->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('state_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-10">
                    <a
                        href="{{ route('city.index') }}"
                        class="btn btn-outline-primary me-4">Cancelar</a>
                    <button
                        type="submit"
                        class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
