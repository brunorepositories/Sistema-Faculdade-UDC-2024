@extends('layouts/contentNavbarLayout')

@section('title', 'Cadastrar Fornecedor')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Cadastrar Fornecedor</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('supplier.store') }}"
                method="POST"
                novalidate>

                @csrf

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="tipoPessoa">Tipo de Pessoa</label>
                    <select
                        required
                        name="tipoPessoa"
                        class="form-select toUpperCase"
                        id="tipoPessoa"
                        onchange="toggleFields()">
                        <option value="J" selected>Jurídica</option>
                        <option value="F">Física</option>
                    </select>
                    @error('tipoPessoa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campos para Pessoa Física -->
                <div class="col-md-5 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="fornecedor">Fornecedor</label>
                    <input
                        name="fornecedor"
                        type="text"
                        class="form-control toUpperCase"
                        id="fornecedor"
                        placeholder="Informe o nome do fornecedor"
                        maxlength="100"
                        value="{{ old('fornecedor') }}">
                    @error('fornecedor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-5 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="apelido">Apelido</label>
                    <input
                        name="apelido"
                        type="text"
                        class="form-control toUpperCase"
                        id="apelido"
                        placeholder="Informe o apelido"
                        maxlength="100"
                        value="{{ old('apelido') }}">
                    @error('apelido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="cpf">CPF</label>
                    <input
                        name="cpf"
                        type="text"
                        class="form-control toUpperCase"
                        id="cpf"
                        placeholder="Informe o CPF"
                        value="{{ old('cpf') }}">
                    @error('cpf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="dataNasc">Data de Nascimento</label>
                    <input
                        name="dataNasc"
                        type="date"
                        class="form-control toUpperCase"
                        id="dataNasc"
                        value="{{ old('dataNasc') }}">
                    @error('dataNasc')
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
                    <label class="form-label toUpperCase" for="fornecedorRazaoSocial">Razão Social</label>
                    <input
                        required
                        name="fornecedorRazaoSocial"
                        type="text"
                        class="form-control toUpperCase"
                        id="fornecedorRazaoSocial"
                        placeholder="Informe a razão social"
                        maxlength="100"
                        value="{{ old('fornecedorRazaoSocial') }}">
                    @error('fornecedorRazaoSocial')
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
                    <label class="form-label toUpperCase" for="cnpj">CNPJ</label>
                    <input
                        name="cnpj"
                        type="text"
                        class="form-control toUpperCase"
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
                    @error('dataFundacao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-12 mt-6 mb-2">
                    <h5>Contato</h5>
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="nomeContato">Nome para Contato</label>
                    <input
                        required
                        name="nomeContato"
                        type="text"
                        class="form-control toUpperCase"
                        id="nomeContato"
                        placeholder="Informe o endereço"
                        value="{{ old('nomeContato') }}">
                    @error('nomeContato')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="celular">Celular</label>
                    <input
                        required
                        name="celular"
                        type="text"
                        class="form-control toUpperCase"
                        id="celular"
                        placeholder="Informe o endereço"
                        value="{{ old('celular') }}">
                    @error('celular')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="telefone">Telefone</label>
                    <input
                        required
                        name="telefone"
                        type="text"
                        class="form-control toUpperCase"
                        id="telefone"
                        placeholder="Informe o endereço"
                        value="{{ old('telefone') }}">
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="email">E-mail</label>
                    <input
                        required
                        name="email"
                        type="text"
                        class="form-control toUpperCase"
                        id="email"
                        placeholder="Informe o endereço"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-6 mb-2">
                    <h5>Endereço</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label toUpperCase" for="logradouro">Logradouro</label>
                    <input
                        required
                        name="logradouro"
                        type="text"
                        class="form-control toUpperCase"
                        id="logradouro"
                        placeholder="Informe o endereço"
                        value="{{ old('logradouro') }}">
                    @error('logradouro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="numero">Número</label>
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
                    <label class="form-label toUpperCase" for="bairro">Bairro</label>
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

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="cep">CEP</label>
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


                <div class="col-12 mt-6 mb-2">
                    <h5>Condição de Pagamento</h5>
                </div>

                <div class="col flex-grow-1">
                    <label class="form-label toUpperCase" for="payment-term_id">Forma de Pagamento</label>
                    <div class="input-group">
                        <select
                            required
                            name="payment-term_id"
                            class="form-select toUpperCase"
                            id="payment-term_id">
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($paymentTerms as $paymentTerm)
                                <option value="{{ $paymentTerm->id }}">
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


                    @error('payment-term_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                            href="{{ route('supplier.index') }}"
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

            if (tipoPessoa === 'F') {
                fisicaFields.forEach(field => field.style.display = 'block');
                juridicaFields.forEach(field => field.style.display = 'none');
            } else {
                fisicaFields.forEach(field => field.style.display = 'none');
                juridicaFields.forEach(field => field.style.display = 'block');
            }
        }

        $(document).ready(function() {
            toggleFields();
        });
    </script>
@endsection
