@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Medidas')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Medidas</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary toUpperCase" href="{{ route('measure.create') }}">Cadastrar Medida</a>
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
                            <th style="width: 150px" class="centered-text">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($measures as $measure)
                            <tr>
                                <td>{{ $measure->id }}</td>
                                <td>{{ $measure->nome }}</td>
                                <td>{{ $measure->sigla }}</td>
                                <td style="width: 150px">
                                    <a class="btn btn-outline-primary rounded-pill border-0"
                                        href="{{ route('measure.edit', $measure->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px"></span>
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $measure->id }}">
                                        <i class='bx bx-trash'></i>
                                    </button>

                                    <!-- Componente de modal de confirmação -->
                                    @include('components.modalConfirmation', [
                                        'objId' => $measure->id,
                                        'objNome' => $measure->nome,
                                        'action' => 'measure.destroy',
                                    ])

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 mt-4">
                {{ $measures->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
