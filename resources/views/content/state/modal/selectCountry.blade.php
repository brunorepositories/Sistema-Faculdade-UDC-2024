<!-- Modal para listagem de países -->
<div class="modal fade"
    data-bs-backdrop="static"
    id="countryModal"
    tabindex="-1"
    aria-labelledby="countryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="countryModalLabel">Selecione um País</h5>
                {{-- <button type="button" id="openCountryCreateModal" class="btn btn-primary">Cadastrar pais</button> --}}
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
                        <tbody id="country-list">
                            @foreach ($countries as $country)
                                <tr class="select-country" data-id="{{ $country->id }}"
                                    data-name="{{ $country->nome }}">
                                    <td>{{ $country->id }}</td>
                                    <td>{{ $country->nome }}</td>
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
{{--
<!-- Modal para cadastrar novo país -->
<div class="modal fade" id="countryCreateModal" tabindex="-1" aria-labelledby="countryCreateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="countryCreateModalLabel">Cadastrar Novo País</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="countryCreateForm">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <label for="nome" class="form-label">Nome do País</label>
                            <input type="text" maxlength="50" class="form-control" id="newCountryName"
                                name="nome" required>
                        </div>
                        <div class="col-2">
                            <label for="sigla" class="form-label">Sigla</label>
                            <input type="text" maxlength="3" class="form-control" id="newCountrySigla"
                                name="sigla" required>
                        </div>
                        <div class="col-2">
                            <label for="ddi" class="form-label">DDI</label>
                            <input type="number" maxlength="3" class="form-control" id="newCountryDDI" name="ddi"
                                required>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end mt-10">

                        <button type="button" id="closeCountryCreateModal"
                            class="btn btn-outline-secondary me-4">Cancelar</button>
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
        // Captura o clique na linha da tabela de países para selecionar o país
        $('.select-country').on('click', function() {
            var countryId = $(this).data('id');
            var countryName = $(this).data('name');

            // Atualiza o campo de seleção de país
            $('#country_id').val(countryId);

            // Fecha o modal de seleção de países
            $('#countryModal').modal('hide');
        });

        // Alternar para o modal de cadastro de país
        // $('#openCountryCreateModal').on('click', function() {
        //     $('#countryModal').modal('hide'); // Fecha o modal de seleção de países
        //     $('#countryCreateModal').modal('show'); // Abre o modal de cadastro de país
        // });

        // Alternar para o modal de seleção de pais
        // $('#closeCountryCreateModal').on('click', function() {

        //     $('#countryCreateModal').modal('hide'); // Fechar modal de cadastro de país
        //     $('#countryModal').modal('show'); // Reabrir o modal de seleção de países
        // });



        // Quando o formulário de cadastro de país for enviado
        // $('#countryCreateForm').on('submit', function(e) {
        //     e.preventDefault();

        //     var newCountryData = {
        //         nome: $('#newCountryName').val(),
        //         sigla: $('#newCountrySigla').val(),
        //         ddi: $('#newCountryDDI').val(),
        //         _token: '{{ csrf_token() }}'
        //     };

        //     $.ajax({
        //         url: '{{ route('country.store') }}', // URL da rota para salvar o país
        //         method: 'POST',
        //         data: newCountryData,
        //         success: function(response) {

        //             // Fechar modal de cadastro de país
        //             $('#countryCreateModal').modal('hide');

        //             // Reabrir o modal de seleção de países
        //             $('#countryModal').modal('show');

        //             // Atualizar a lista de países no modal de seleção
        //             $('#country-list').append('<tr class="select-country" data-id="' +
        //                 response.id + '" data-name="' + response.nome + '"><td>' +
        //                 response.id + '</td><td>' + response.nome + '</td></tr>');

        //             // Adicionar o novo país ao select no formulário principal
        //             $('#country_id').append('<option value="' + response.id + '">' +
        //                 response.nome + '</option>');

        //             // Resetar o formulário de cadastro de país
        //             $('#countryCreateForm')[0].reset();
        //         },
        //         error: function(response) {
        //             alert('Erro ao cadastrar país. Tente novamente.');
        //         }
        //     });
        // });
    });
</script>
