<!-- Modal para listagem de medidas -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="measureModal"
    tabindex="-1"
    aria-labelledby="measureModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <!-- Título da Modal -->
                <h5 class="modal-title" id="measureModalLabel">Selecione uma Medida</h5>

                <!-- Botão para Cadastrar Nova Unidade de Medida, ao lado do título -->
                <button id="showNewMeasureFormBtn" class="btn btn-secondary">Novo</button>
            </div>
            <div class="modal-body">
                <!-- Campo de filtro para as medidas -->
                <input type="text" id="measureFilter" class="form-control mb-3" placeholder="Filtrar medidas..." />

                <!-- Formulário de cadastro (inicialmente oculto) -->
                <div id="newMeasureForm" class="mb-3" style="display: none;">
                    <div class="mb-3">
                        <label for="newMeasureName" class="form-label">Nome da nova medida</label>
                        <input type="text" id="newMeasureName" class="form-control" placeholder="Digite o nome da nova medida">
                    </div>
                    <div class="mb-3">
                        <label for="newMeasureSigla" class="form-label">Sigla da nova medida</label>
                        <input type="text" id="newMeasureSigla" class="form-control" placeholder="Digite a sigla da nova medida">
                    </div>
                    <button id="addMeasureBtn" class="btn btn-primary mb-3">Adicionar Nova Medida</button>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody id="measure-list">
                            @foreach ($measures as $measure)
                                <tr class="select-measure" data-id="{{ $measure->id }}"
                                    data-name="{{ $measure->nome }}">
                                    <td>{{ $measure->id }}</td>
                                    <td>{{ $measure->nome }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Filtro de medidas
        $('#measureFilter').on('keyup', function() {
            var filterValue = $(this).val().toLowerCase();
            $('#measure-list tr').each(function() {
                var measureName = $(this).data('name').toLowerCase();
                if (measureName.indexOf(filterValue) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Captura o clique na linha da tabela de medidas para selecionar a medida
        $('.select-measure').on('click', function() {
            var measureId = $(this).data('id');
            var measureName = $(this).data('name');

            // Atualiza o campo de seleção de medida
            $('#measure_id').val(measureId);

            // Fecha o modal de seleção de medidas
            $('#measureModal').modal('hide');
        });

        // Exibe o formulário para adicionar nova unidade de medida
        $('#showNewMeasureFormBtn').on('click', function() {
            $('#newMeasureForm').show(); // Exibe o formulário
            $(this).hide(); // Esconde o botão
        });

        // Adicionar uma nova medida
        $('#addMeasureBtn').on('click', function() {
            var newMeasureName = $('#newMeasureName').val().trim();
            var newMeasureSigla = $('#newMeasureSigla').val().trim();

            if (newMeasureName && newMeasureSigla) {
                $.ajax({
                    url: '/measure', // URL para onde a solicitação será enviada
                    method: 'POST',
                    data: {
                        nome: newMeasureName,
                        sigla: newMeasureSigla,
                        from_api: true, // Parâmetro adicional para identificar a requisição como vinda da API
                        _token: '{{ csrf_token() }}', // CSRF token para segurança
                    },
                    success: function(response) {
                        if (response.success) {
                            // Novo registro retornado pela API
                            var newRow = `<tr class="select-measure" data-id="${response.measure.id}" data-name="${response.measure.nome}">
                                            <td>${response.measure.id}</td>
                                            <td>${response.measure.nome}</td>
                                        </tr>`;
                            $('#measure-list').append(newRow);

                            // Limpa os campos e esconde o formulário de novo cadastro
                            $('#newMeasureName').val('');
                            $('#newMeasureSigla').val('');
                            $('#newMeasureForm').hide();
                            $('#showNewMeasureFormBtn').show();
                        } else {
                            alert('Erro ao adicionar a medida.');
                        }
                    },
                    error: function() {
                        alert('Ocorreu um erro ao tentar adicionar a medida.');
                    }
                });
            } else {
                alert('Por favor, preencha todos os campos.');
            }
        });

        // Delegação de evento para as novas linhas
        $('#measure-list').on('click', '.select-measure', function() {
            var measureId = $(this).data('id');
            var measureName = $(this).data('name');

            // Verificar se a opção já existe no select
            if ($('#measure_id option[value="' + measureId + '"]').length === 0) {
                // Adiciona a nova opção ao select
                $('#measure_id').append(
                    `<option value="${measureId}">${measureName}</option>`
                );
            }

            // Atualiza o valor do select com a medida selecionada
            $('#measure_id').val(measureId);

            // Fecha o modal de seleção de medidas
            $('#measureModal').modal('hide');
        });
    });
</script>
