@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Estados')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Estados</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary" href="{{ route('state.create') }}">Cadastrar estado</a>
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
                            <th>UF</th>
                            <th>País</th> <!-- Nome do país relacionado -->
                            <th class="centered-text size-col-action">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($states as $state)
                            <tr>
                                <td>{{ $state->id }}</td>
                                <td>{{ $state->nome }}</td>
                                <td>{{ $state->uf }}</td>
                                <td>{{ $state->country->nome }}</td> <!-- Nome do país associado -->
                                <td class="size-col-action">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('state.edit', $state->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $state->id }}">
                                        <i class='bx bx-trash'></i>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $state->id,
                                        'objNome' => $state->nome,
                                        'action' => 'state.destroy',
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
