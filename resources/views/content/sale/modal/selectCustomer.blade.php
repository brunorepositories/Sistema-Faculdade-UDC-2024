<!-- Modal para listagem de medidas -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="customerModal"
    tabindex="-1"
    aria-labelledby="customerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="width: 800px">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="customerModalLabel">Selecione um Cliente</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Documento</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody id="customer-list">
                            @foreach ($customers as $customer)
                                <tr class="select-customer" data-id="{{ $customer->id }}"
                                    data-name="{{ $customer->nome }}">
                                    <td>{{ $customer->id }}</td>
                                    <td>
                                        @if ($customer->tipoPessoa == 'F')
                                            Física
                                        @else
                                            Jurídica
                                        @endif
                                    </td>
                                    <td>{{ $customer->clienteRazaoSocial }}</td>
                                    <td>{{ $customer->cpfCnpj }}
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
        $('.select-customer').on('click', function() {
            var customerId = $(this).data('id');
            var customerName = $(this).data('fornecedorRazaoSocial');

            // Atualiza o campo de seleção de medida
            $('#customer_id').val(customerId).trigger('change');

            // Fecha o modal de seleção de medidas
            $('#customerModal').modal('hide');

        });
    });
</script>
