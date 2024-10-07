@extends('layouts/contentNavbarLayout')

@section('title', 'Listar paises')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Países</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary" href="{{ route('country.create') }}">Cadastrar país</a>
            </div>
        </div>

        <div class="card-body">

            @include('components.feedbackMessage')

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>DDI</th>
                            <th style="width: 150px" class="centered-text">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $country->id }}</td>
                                <td>{{ $country->nome }}</td>
                                <td>{{ $country->sigla }}</td>
                                <td>{{ $country->ddi }}</td>
                                <td style="width: 150px">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('country.edit', $country->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $country->id }}">
                                        <span class="tf-icons bx bx-trash bx-22px"></span>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $country->id,
                                        'objNome' => $country->nome,
                                        'action' => 'country.destroy',
                                    ])

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
