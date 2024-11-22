<!-- Modal para listagem de formas de pagamento -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="productModal"
    tabindex="-1"
    aria-labelledby="productModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="productModalLabel">Selecione a Forma de Pagamento</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Produto</th>
                                <th>Unidade de Medida</th>
                            </tr>
                        </thead>
                        <tbody id="payment-form-list">
                            @foreach ($products as $product)
                                <tr class="select-payment-form" data-id="{{ $product->id }}"
                                    data-name="{{ $product->nome }}">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->nome }}</td>
                                    <td>{{ $product->measure->sigla }}</td>
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
        // Captura o clique na linha da tabela de formas de pagamento para selecionar a forma de pagamento
        $('.select-payment-form').on('click', function() {
            var productId = $(this).data('id');
            var productName = $(this).data('name');

            // Atualiza o campo de seleção de forma de pagamento
            $('#product_id').val(productId);

            // Fecha o modal de seleção de formas de pagamento
            $('#productModal').modal('hide');
        });
    });
</script>
