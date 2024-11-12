<!-- Modal para listagem de estados -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="stateModal"
    tabindex="-1"
    aria-labelledby="stateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="stateModalLabel">Selecione o Estado</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>UF</th>
                            </tr>
                        </thead>
                        <tbody id="state-list">
                            @foreach ($states as $state)
                                <tr class="select-state"
                                    data-id="{{ $state->id }}"
                                    data-name="{{ $state->nome }}"
                                    data-uf="{{ $state->uf }}">
                                    <td>{{ $state->id }}</td>
                                    <td>{{ $state->nome }}</td>
                                    <td>{{ $state->uf }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary toUpperCase"
                    data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cadastrar novo estado -->
{{-- <div class="modal fade" id="stateCreateModal" tabindex="-1" aria-labelledby="stateCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stateCreateModalLabel">Cadastrar Novo Estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="stateCreateForm">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <label for="nome" class="form-label">Nome do Estado</label>
                            <input type="text" maxlength="50" class="form-control" id="newStateName" name="nome" required>
                        </div>
                        <div class="col-4">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" maxlength="2" class="form-control" id="newStateUF" name="uf" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-10">
                        <button type="button" id="closeStateCreateModal" class="btn btn-outline-secondary me-4">Cancelar</button>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Captura o clique na linha da tabela de estados para selecionar o estado
        $('.select-state').on('click', function() {
            var stateId = $(this).data('id');
            var stateName = $(this).data('name');
            var stateUF = $(this).data('uf');

            // Atualiza o campo de seleção de estado
            $('#state_id').val(stateId);

            // Fecha o modal de seleção de estados
            $('#stateModal').modal('hide');
        });

        // Alternar para o modal de cadastro de estado
        // $('#openStateCreateModal').on('click', function() {
        //     $('#stateModal').modal('hide'); // Fecha o modal de seleção de estados
        //     $('#stateCreateModal').modal('show'); // Abre o modal de cadastro de estado
        // });

        // Alternar para o modal de seleção de estado
        // $('#closeStateCreateModal').on('click', function() {
        //     $('#stateCreateModal').modal('hide'); // Fecha o modal de cadastro de estado
        //     $('#stateModal').modal('show'); // Reabre o modal de seleção de estados
        // });

        // Quando o formulário de cadastro de estado for enviado
        // $('#stateCreateForm').on('submit', function(e) {
        //     e.preventDefault();

        //     var newStateData = {
        //         nome: $('#newStateName').val(),
        //         uf: $('#newStateUF').val(),
        //         _token: '{{ csrf_token() }}'
        //     };

        //     $.ajax({
        //         url: '{{ route('state.store') }}', // URL da rota para salvar o estado
        //         method: 'POST',
        //         data: newStateData,
        //         success: function(response) {
        //             // Fechar modal de cadastro de estado
        //             $('#stateCreateModal').modal('hide');

        //             // Reabrir o modal de seleção de estados
        //             $('#stateModal').modal('show');

        //             // Atualizar a lista de estados no modal de seleção
        //             $('#state-list').append('<tr class="select-state" data-id="' +
        //                 response.id + '" data-name="' + response.nome + '" data-uf="' +
        //                 response.uf + '"><td>' +
        //                 response.id + '</td><td>' + response.nome + '</td><td>' +
        //                 response.uf + '</td></tr>');

        //             // Adicionar o novo estado ao select no formulário principal
        //             $('#state_id').append('<option value="' + response.id + '">' +
        //                 response.nome + ' (' + response.uf + ')</option>');

        //             // Resetar o formulário de cadastro de estado
        //             $('#stateCreateForm')[0].reset();
        //         },
        //         error: function(response) {
        //             alert('Erro ao cadastrar estado. Tente novamente.');
        //         }
        //     });
        // });
    });
</script>
