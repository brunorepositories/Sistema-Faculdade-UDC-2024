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
                <h5 class="modal-title" id="measureModalLabel">Selecione uma Medida</h5>
            </div>
            <div class="modal-body">
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
        // Captura o clique na linha da tabela de medidas para selecionar a medida
        $('.select-measure').on('click', function() {
            var measureId = $(this).data('id');
            var measureName = $(this).data('name');

            // Atualiza o campo de seleção de medida
            $('#measure_id').val(measureId);

            // Fecha o modal de seleção de medidas
            $('#measureModal').modal('hide');
        });
    });
</script>
