@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Cidades')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Cidades</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary" href="{{ route('city.create') }}">Cadastrar cidade</a>
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
                            <th>DDD</th>
                            <th>Estado</th> <!-- Nome do estado relacionado -->
                            <th style="width: 150px" class="centered-text">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->nome }}</td>
                                <td>{{ $city->ddd }}</td>
                                <td>{{ $city->state->nome }}</td> <!-- Nome do estado associado -->
                                <td style="width: 150px">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('city.edit', $city->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $city->id }}">
                                        <span class="tf-icons bx bx-trash bx-22px"></span>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $city->id,
                                        'objNome' => $city->nome,
                                        'action' => 'city.destroy',
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
