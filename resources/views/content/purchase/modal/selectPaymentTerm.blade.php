<!-- Modal para listagem de formas de pagamento -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="paymentTermModal"
    tabindex="-1"
    aria-labelledby="paymentTermModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="paymentTermModalLabel">Selecione a Forma de Pagamento</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Forma de Pagamento</th>
                            </tr>
                        </thead>
                        <tbody id="payment-form-list">
                            @foreach ($paymentTerms as $paymentTerm)
                                <tr class="select-payment-form" data-id="{{ $paymentTerm->id }}"
                                    data-name="{{ $paymentTerm->condicaoPagamento }}">
                                    <td>{{ $paymentTerm->id }}</td>
                                    <td>{{ $paymentTerm->condicaoPagamento }}</td>
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
            var paymentTermId = $(this).data('id');
            var paymentTermName = $(this).data('name');

            // Atualiza o campo de seleção de forma de pagamento
            $('#payment_term_id').val(paymentTermId);

            // Fecha o modal de seleção de formas de pagamento
            $('#paymentTermModal').modal('hide');
        });
    });
</script>
