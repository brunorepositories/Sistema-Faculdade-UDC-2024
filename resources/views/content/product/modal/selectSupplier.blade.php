<!-- Modal para listagem de medidas -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="supplierModal"
    tabindex="-1"
    aria-labelledby="supplierModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="width: 800px">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="supplierModalLabel">Selecione um Fornecedor</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Tipo</th>
                                <th>Fornecedor</th>
                                <th>Documento</th>
                            </tr>
                        </thead>
                        <tbody id="supplier-list">
                            @foreach ($suppliers as $supplier)
                                <tr class="select-supplier" data-id="{{ $supplier->id }}"
                                    data-name="{{ $supplier->nome }}">
                                    <td>{{ $supplier->id }}</td>
                                    <td>
                                        @if ($supplier->tipoPessoa == 'F')
                                            Física
                                        @else
                                            Jurídica
                                        @endif
                                    </td>
                                    <td>{{ $supplier->fornecedorRazaoSocial }}</td>
                                    <td>{{ $supplier->cpfCnpj }}
                                    </td>
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

<script>
    $(document).ready(function() {
        // Captura o clique na linha da tabela de medidas para selecionar a medida
        $('.select-supplier').on('click', function() {
            var supplierId = $(this).data('id');
            var supplierName = $(this).data('fornecedorRazaoSocial');

            // Atualiza o campo de seleção de medida
            $('#supplier_id').val(supplierId).trigger('change');

            // Fecha o modal de seleção de medidas
            $('#supplierModal').modal('hide');

        });
    });
</script>
