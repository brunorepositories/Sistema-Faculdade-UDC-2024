@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Cliente')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar Cliente</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('customer.store') }}"
                method="POST"
                novalidate>

                @csrf

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="tipoPessoa">Tipo de Pessoa<span
                            class="labelRequired">*</span></label>
                    <select
                        required
                        name="tipoPessoa"
                        class="form-select toUpperCase"
                        id="tipoPessoa"
                        onchange="toggleFields()">
                        <option value="F" selected>Física</option>
                        <option value="J">Jurídica</option>
                    </select>
                    @error('tipoPessoa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campos para Pessoa Física -->
                <div class="col-md-5 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="cliente">Cliente<span
                            class="labelRequired">*</span></label>
                    <input
                        name="cliente"
                        type="text"
                        class="form-control toUpperCase isRequiredFisica"
                        id="cliente"
                        placeholder="Informe o nome do Cliente"
                        maxlength="100"
                        value="{{ old('cliente') }}">
                    @error('cliente')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-5 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="apelidoNomeFantasia">Apelido</label>
                    <input
                        name="apelidoNomeFantasia"
                        type="text"
                        class="form-control toUpperCase"
                        id="apelidoNomeFantasia"
                        placeholder="Informe o apelido"
                        maxlength="100"
                        value="{{ old('apelidoNomeFantasia') }}">
                    @error('apelidoNomeFantasia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="cpf">CPF<span class="labelRequired">*</span></label>
                    <input
                        name="cpf"
                        type="text"
                        class="form-control toUpperCase isRequiredFisica"
                        id="cpf"
                        placeholder="Informe o CPF"
                        value="{{ old('cpf') }}">
                    @error('cpf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="dataNascimento">Data de Nascimento<span
                            class="labelRequired">*</span></label>
                    <input
                        name="dataNascimento"
                        type="date"
                        class="form-control toUpperCase isRequiredFisica"
                        id="dataNascimento"
                        value="{{ old('dataNascimento') }}">
                    @error('dataNascimento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="sexo">Sexo</label>
                    <select name="sexo" class="form-select toUpperCase" id="sexo">
                        <option value="" disabled selected>Selecione</option>
                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Feminino</option>
                    </select>
                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="rg">RG</label>
                    <input
                        name="rg"
                        type="text"
                        class="form-control toUpperCase"
                        id="rg"
                        placeholder="Informe o RG"
                        value="{{ old('rg') }}">
                    @error('rg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campos para Pessoa Jurídica -->
                <div class="col-md-5 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="razaoSocial">Razão Social<span
                            class="labelRequired">*</span></label>
                    <input
                        name="razaoSocial"
                        type="text"
                        class="form-control toUpperCase isRequiredJuridica"
                        id="razaoSocial"
                        placeholder="Informe a razão social"
                        maxlength="100"
                        value="{{ old('razaoSocial') }}">
                    @error('razaoSocial')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-5 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="apelidoNomeFantasia">Nome Fantasia</label>
                    <input
                        name="apelidoNomeFantasia"
                        type="text"
                        class="form-control toUpperCase"
                        id="apelidoNomeFantasia"
                        placeholder="Informe o nome fantasia"
                        maxlength="100"
                        value="{{ old('apelidoNomeFantasia') }}">
                    @error('apelidoNomeFantasia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="cnpj">CNPJ<span class="labelRequired">*</span></label>
                    <input
                        name="cnpj"
                        type="text"
                        class="form-control toUpperCase isRequiredJuridica"
                        id="cnpj"
                        placeholder="Informe o CNPJ"
                        value="{{ old('cnpj') }}">
                    @error('cnpj')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="ie">Inscrição Estadual</label>
                    <input
                        name="ie"
                        type="text"
                        class="form-control toUpperCase"
                        id="ie"
                        placeholder="Informe a inscrição estadual"
                        value="{{ old('ie') }}">
                    @error('ie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="dataFundacao">Data de Fundação</label>
                    <input
                        name="dataFundacao"
                        type="date"
                        class="form-control toUpperCase"
                        id="dataFundacao"
                        value="{{ old('dataFundacao') }}">
                    @error('dataNasc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-8 mb-2">
                    <h5>Contato</h5>
                </div>

                <div class="col-md-3 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="nomeContato">Nome para Contato<span
                            class="labelRequired">*</span></label>
                    <input
                        name="nomeContato"
                        type="text"
                        class="form-control toUpperCase isRequiredJuridica"
                        id="nomeContato"
                        placeholder="Informe o nome para contato"
                        value="{{ old('nomeContato') }}">
                    @error('nomeContato')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label toUpperCase" for="celular">Celular<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="celular"
                        type="text"
                        class="form-control toUpperCase"
                        id="celular"
                        placeholder="Informe o celular"
                        value="{{ old('celular') }}">
                    @error('celular')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="instagram">Instagram</label>
                    <input
                        name="instagram"
                        type="text"
                        class="form-control toUpperCase"
                        id="instagram"
                        placeholder="Informe o instagram"
                        value="{{ old('instagram') }}">
                    @error('instagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="telefone">Telefone</label>
                    <input
                        name="telefone"
                        type="text"
                        class="form-control toUpperCase"
                        id="telefone"
                        placeholder="Informe o telefone"
                        value="{{ old('telefone') }}">
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="email">E-mail</label>
                    <input
                        name="email"
                        type="text"
                        class="form-control toUpperCase"
                        id="email"
                        placeholder="Informe o e-mail"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-12 mt-8 mb-4">
                    <h5>Endereço</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label toUpperCase" for="endereco">Logradouro<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="endereco"
                        type="text"
                        class="form-control toUpperCase"
                        id="endereco"
                        placeholder="Informe o endereco"
                        value="{{ old('endereco') }}">
                    @error('endereco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="numero">Número<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="numero"
                        type="text"
                        class="form-control toUpperCase"
                        id="numero"
                        placeholder="Informe o número"
                        value="{{ old('numero') }}">
                    @error('numero')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="complemento">Complemento</label>
                    <input
                        name="complemento"
                        type="text"
                        class="form-control toUpperCase"
                        id="complemento"
                        placeholder="Informe o complemento"
                        value="{{ old('complemento') }}">
                    @error('complemento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="bairro">Bairro<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="bairro"
                        type="text"
                        class="form-control toUpperCase"
                        id="bairro"
                        placeholder="Informe o bairro"
                        value="{{ old('bairro') }}">
                    @error('bairro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="city_id">Cidade<span
                            class="labelRequired">*</span></label>
                    <select required name="city_id" class="form-select toUpperCase" id="city_id">
                        <option value="" disabled selected>Selecione</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->id }} - {{ $city->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- {{ dd($cities) }} --}}

                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="cep">CEP<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="cep"
                        type="text"
                        class="form-control toUpperCase"
                        id="cep"
                        placeholder="Informe o CEP"
                        value="{{ old('cep') }}">
                    @error('cep')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-8 mb-4">
                    <h5>Condição de Pagamento</h5>
                </div>

                <div class="col flex-grow-1">
                    <label class="form-label toUpperCase" for="payment_term_id">Condição de Pagamento<span
                            class="labelRequired">*</span></label>
                    <div class="input-group">
                        <select
                            required
                            name="payment_term_id"
                            class="form-select toUpperCase"
                            id="payment_term_id">
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($paymentTerms as $paymentTerm)
                                <option value="{{ $paymentTerm->id }}"
                                    {{ old('payment_term_id') == $paymentTerm->id ? 'selected' : '' }}>
                                    {{ $paymentTerm->id }} -
                                    {{ $paymentTerm->condicaoPagamento }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Botão de ação do modal de selecionar forma de pagamento --}}
                        <button class="btn btn-outline-secondary"
                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#paymentTermModal">
                            <span class="tf-icons bx bx-search bx-18px"></span>
                        </button>
                        {{-- End Button --}}
                    </div>


                    @error('payment_term_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="col-md-12 mb-3">
                    <label class="form-label toUpperCase" for="observacao">Observação</label>
                    <textarea
                        name="observacao"
                        class="form-control toUpperCase"
                        id="observacao"
                        rows="3">{{ old('observacao') }}</textarea>
                </div> --}}

                <!-- Demais campos do formulário continuam aqui... -->


                <div class="d-flex justify-content-between align-items-center mt-10">
                    <div>
                        <input type="hidden" name="ativo" value="1">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="ativo"
                            id="ativo"
                            value="1"
                            disabled
                            checked>
                        <label class="form-check-label toUpperCase" for="ativo">Ativo</label>
                    </div>
                    <div>
                        <a
                            href="{{ route('customer.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success toUpperCase">Cadastrar</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

    <script>
        function toggleFields() {
            const tipoPessoa = document.getElementById('tipoPessoa').value;
            const fisicaFields = document.querySelectorAll('.fisica-fields');
            const juridicaFields = document.querySelectorAll('.juridica-fields');

            // Exibir campos com base no tipo de pessoa
            fisicaFields.forEach(field => {
                const input = field.querySelector('input, select, textarea');
                field.style.display = tipoPessoa === 'F' ? 'block' : 'none';
                if (field.classList.contains('isRequiredFisica')) {
                    input.required = tipoPessoa === 'F';
                }
            });

            juridicaFields.forEach(field => {
                const input = field.querySelector('input, select, textarea');
                field.style.display = tipoPessoa === 'J' ? 'block' : 'none';
                if (field.classList.contains('isRequiredJuridica')) {
                    input.required = tipoPessoa === 'J';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', toggleFields);
        document.getElementById('tipoPessoa').addEventListener('change', toggleFields);
    </script>




    {{-- <script>
        function toggleFields() {
            const tipoPessoa = document.getElementById('tipoPessoa').value;
            const fisicaFields = document.querySelectorAll('.fisica-fields');
            const juridicaFields = document.querySelectorAll('.juridica-fields');

            if (tipoPessoa === 'F') {
                fisicaFields.forEach(field => field.style.display = 'block');
                juridicaFields.forEach(field => field.style.display = 'none');

                juridicaFields.forEach(field => field.style.display = 'none');
            } else {
                fisicaFields.forEach(field => field.style.display = 'none');
                juridicaFields.forEach(field => field.style.display = 'block');
            }
        }

        // Inicializa os campos com base na seleção atual
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script> --}}
@endsection
