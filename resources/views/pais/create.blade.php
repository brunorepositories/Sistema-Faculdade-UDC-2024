@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar País')




@section('content')



    <div class="card mb-10">
        <h4 class="card-header">Cadastrar novo país</h4>

        <div class="card-body">

            @if ($errors->any())
                <div>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="m-0">

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('pais.store') }}"
                method="POST"
                novalidate="">

                @csrf

                <div class="col-8">
                    <label
                        class="form-label"
                        for="nome">Nome do País</label>
                    <input
                        required
                        name="nome"
                        type="text"
                        class="form-control"
                        id="nome"
                        placeholder="Informe o nome do país"
                        maxlength="50"
                        value="{{ old('nome') }}">
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
                        placeholder="Informe a sigla do país"
                        maxlength="3"
                        value="{{ old('sigla') }}">
                    @error('sigla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <label
                        class="form-label"
                        for="ddi">DDI</label>
                    <input
                        required
                        name="ddi"
                        type="number"
                        class="form-control"
                        id="ddi"
                        placeholder="Informe o código DDI"
                        maxlength="5"
                        value="{{ old('ddi') }}">
                    @error('ddi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-10">
                    <a
                        href="{{ url()->previous() }}"
                        class="btn btn-outline-primary me-4">Cancelar</a>
                    <button
                        type="submit"
                        class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
