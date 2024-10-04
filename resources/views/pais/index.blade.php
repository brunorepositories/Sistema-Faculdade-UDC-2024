@extends('layouts/contentNavbarLayout')

@section('title', 'Paises - Listagem')

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Países</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary" href="{{ route('pais.create') }}"> Cadastrar país </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>DDI</th>
                            <th class="">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($paises as $pais)
                            <tr>
                                <td>{{ $pais->id }}</td>
                                <td>{{ $pais->nome }}</td>
                                <td>{{ $pais->sigla }}</td>
                                <td>{{ $pais->ddi }}</td>
                                <td>
                                    <a class="btn btn-outline-primary border-0 me-5"
                                        href="{{ route('pais.edit', $pais->id) }}">
                                        <span class="tf-icons bx bx-edit bx-22px me-2"></span>
                                        Editar
                                    </a>

                                    <!-- Botão que abre o modal de exclusão -->
                                    <button type="button" class="btn btn-outline-danger border-0" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $pais->id }}">
                                        <span class="tf-icons bx bx-trash bx-22px me-2"></span>
                                        Excluir
                                    </button>

                                    <!-- Modal de confirmação de exclusão -->
                                    <div class="modal fade" id="deleteModal{{ $pais->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $pais->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $pais->id }}">Confirmar
                                                        exclusão</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza que deseja excluir o país {{ $pais->nome }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('pais.destroy', $pais->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
