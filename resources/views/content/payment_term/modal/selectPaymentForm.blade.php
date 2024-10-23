<!-- Modal para listagem de formas de pagamento -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="paymentFormModal"
    tabindex="-1"
    aria-labelledby="paymentFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="paymentFormModalLabel">Selecione uma Forma de Pagamento</h5>
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
                            @foreach ($paymentForms as $paymentForm)
                                <tr class="select-payment-form" data-id="{{ $paymentForm->id }}"
                                    data-name="{{ $paymentForm->formaPagamento }}">
                                    <td>{{ $paymentForm->id }}</td>
                                    <td>{{ $paymentForm->formaPagamento }}</td>
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
        // Captura o clique na linha da tabela de formas de pagamento para selecionar a forma de pagamento
        $('.select-payment-form').on('click', function() {
            var paymentFormId = $(this).data('id');
            var paymentFormName = $(this).data('name');

            // Atualiza o campo de seleção de forma de pagamento
            $('#payment_form_id').val(paymentFormId);

            // Fecha o modal de seleção de formas de pagamento
            $('#paymentFormModal').modal('hide');
        });
    });
</script>
