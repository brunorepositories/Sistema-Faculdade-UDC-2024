@extends('layouts/contentNavbarLayout')

@section('title', 'Alterar Cliente')

@section('content')
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between">
            <h4>Alterar Cliente</h4>

            <div>
                <span class="badge bg-label-secondary rounded-pill">Cadastro:
                    {{ date('d/m/Y H:i', strtotime($customer->created_at)) }}
                </span>
                <span class="badge bg-label-secondary rounded-pill">Última alteração:
                    {{ $customer->updated_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('customer.update', $customer->id) }}"
                method="POST"
                novalidate>

                @csrf
                @method('PUT')

                <div class="col-1">
                    <label
                        class="form-label toUpperCase"
                        for="id">Código</label>
                    <input
                        required
                        name="id"
                        class="form-control toUpperCase"
                        id="id"
                        disabled
                        value="{{ old('id', $customer->id) }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label toUpperCase" for="tipoPessoa">Tipo de Pessoa<span
                            class="labelRequired">*</span></label>
                    <select
                        required
                        name="tipoPessoa"
                        class="form-select toUpperCase"
                        id="tipoPessoa"
                        onchange="toggleFields()">
                        <option value="F" {{ old('tipoPessoa', $customer->tipoPessoa) === 'F' ? 'selected' : '' }}>
                            Física</option>
                        <option value="J" {{ old('tipoPessoa', $customer->tipoPessoa) === 'J' ? 'selected' : '' }}>
                            Jurídica</option>
                    </select>
                    @error('tipoPessoa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campos para Pessoa Física -->
                <div class="col-md-5 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="clienteRazaoSocial">Cliente<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="clienteRazaoSocial"
                        type="text"
                        class="form-control toUpperCase fisica-input"
                        id="clienteRazaoSocial"
                        placeholder="Informe o nome do Cliente"
                        maxlength="100"
                        value="{{ old('clienteRazaoSocial', $customer->clienteRazaoSocial) }}">
                    @error('clienteRazaoSocial')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="apelidoNomeFantasia">Apelido</label>
                    <input
                        name="apelidoNomeFantasia"
                        type="text"
                        class="form-control toUpperCase fisica-input"
                        id="apelidoNomeFantasia"
                        placeholder="Informe o apelido"
                        maxlength="100"
                        value="{{ old('apelidoNomeFantasia', $customer->apelidoNomeFantasia) }}">
                    @error('apelidoNomeFantasia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="cpfCnpj">CPF<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="cpfCnpj"
                        type="text"
                        class="form-control toUpperCase fisica-input"
                        id="cpfCnpj"
                        placeholder="Informe o CPF"
                        value="{{ old('cpfCnpj', $customer->cpfCnpj) }}">
                    @error('cpfCnpj')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="rgIe">RG</label>
                    <input
                        name="rgIe"
                        type="text"
                        class="form-control toUpperCase fisica-input"
                        id="rgIe"
                        placeholder="Informe o RG"
                        value="{{ old('rgIe', $customer->rgIe) }}">
                    @error('rgIe')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="dataNasc">Data de Nascimento</label>
                    <input
                        name="dataNasc"
                        type="date"
                        class="form-control toUpperCase fisica-input"
                        id="dataNasc"
                        value="{{ old('dataNasc', $customer->dataNasc) }}">
                    @error('dataNasc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3 fisica-fields">
                    <label class="form-label toUpperCase" for="sexo">Sexo</label>
                    <select name="sexo" class="form-select toUpperCase fisica-input" id="sexo">
                        <option value="" disabled>Selecione</option>
                        <option value="M" {{ old('sexo', $customer->sexo) == 'M' ? 'selected' : '' }}>Masculino
                        </option>
                        <option value="F" {{ old('sexo', $customer->sexo) == 'F' ? 'selected' : '' }}>Feminino
                        </option>
                    </select>
                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campos para Pessoa Jurídica -->
                <div class="col-md-5 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="clienteRazaoSocial">Razão Social<span
                            class="labelRequired">*</span></label>
                    <input
                        required
                        name="clienteRazaoSocial"
                        type="text"
                        class="form-control toUpperCase juridica-input"
                        id="clienteRazaoSocial"
                        placeholder="Informe a razão social"
                        maxlength="100"
                        value="{{ old('clienteRazaoSocial', $customer->clienteRazaoSocial) }}">
                    @error('clienteRazaoSocial')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="apelidoNomeFantasia">Nome Fantasia</label>
                    <input
                        name="apelidoNomeFantasia"
                        type="text"
                        class="form-control toUpperCase juridica-input"
                        id="apelidoNomeFantasia"
                        placeholder="Informe o nome fantasia"
                        maxlength="100"
                        value="{{ old('apelidoNomeFantasia', $customer->apelidoNomeFantasia) }}">
                    @error('apelidoNomeFantasia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="cpfCnpj">CNPJ<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="cpfCnpj"
                        type="text"
                        class="form-control toUpperCase juridica-input"
                        id="cpfCnpj"
                        placeholder="Informe o CNPJ"
                        value="{{ old('cpfCnpj', $customer->cpfCnpj) }}">
                    @error('cpfCnpj')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="rgIe">Inscrição Estadual</label>
                    <input
                        name="rgIe"
                        type="text"
                        class="form-control toUpperCase juridica-input"
                        id="rgIe"
                        placeholder="Informe a inscrição estadual"
                        value="{{ old('rgIe', $customer->rgIe) }}">
                    @error('rgIe')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3 juridica-fields">
                    <label class="form-label toUpperCase" for="dataNasc">Data de Fundação</label>
                    <input
                        name="dataNasc"
                        type="date"
                        class="form-control toUpperCase juridica-input"
                        id="dataNasc"
                        value="{{ old('dataNasc', $customer->dataNasc) }}">
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
                        required
                        name="nomeContato"
                        type="text"
                        class="form-control toUpperCase juridica-input"
                        id="nomeContato"
                        placeholder="Informe o nome para contato"
                        value="{{ old('nomeContato', $customer->nomeContato) }}">
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
                        value="{{ old('celular', $customer->celular) }}">
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
                        value="{{ old('instagram', $customer->instagram) }}">
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
                        value="{{ old('telefone', $customer->telefone) }}">
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
                        value="{{ old('email', $customer->email) }}">
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
                        value="{{ old('endereco', $customer->endereco) }}">
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
                        value="{{ old('numero', $customer->numero) }}">
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
                        value="{{ old('complemento', $customer->complemento) }}">
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
                        value="{{ old('bairro', $customer->bairro) }}">
                    @error('bairro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="city_id">Cidade<span
                            class="labelRequired">*</span></label>
                    <select required name="city_id" class="form-select toUpperCase" id="city_id">
                        <option value="" disabled>Selecione</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                                {{ old('city_id', $customer->city_id) == $city->id ? 'selected' : '' }}>
                                {{ $city->id }} - {{ $city->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label toUpperCase" for="cep">CEP<span class="labelRequired">*</span></label>
                    <input
                        required
                        name="cep"
                        type="text"
                        class="form-control toUpperCase"
                        id="cep"
                        placeholder="Informe o CEP"
                        value="{{ old('cep', $customer->cep) }}">
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
                            <option value="" disabled>Selecione</option>
                            @foreach ($paymentTerms as $paymentTerm)
                                <option value="{{ $paymentTerm->id }}"
                                    {{ old('payment_term_id', $customer->payment_term_id) == $paymentTerm->id ? 'selected' : '' }}>
                                    {{ $paymentTerm->id }} -
                                    {{ $paymentTerm->condicaoPagamento }}
                                </option>
                            @endforeach
                        </select>

                        <button class="btn btn-outline-secondary"
                            style="border-top-right-radius: var(--bs-border-radius); border-bottom-right-radius: var(--bs-border-radius);"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#paymentTermModal">
                            <span class="tf-icons bx bx-search bx-18px"></span>
                        </button>
                    </div>

                    @error('payment_term_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-10">
                    <div>
                        <input type="hidden" name="ativo" value="0">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="ativo"
                            id="ativo"
                            value="1"
                            {{ old('ativo', $customer->ativo) ? 'checked' : '' }}>
                        <label class="form-check-label toUpperCase" for="ativo">Ativo</label>
                    </div>
                    <div>
                        <a
                            href="{{ route('customer.index') }}"
                            class="btn btn-outline-secondary me-4 toUpperCase">Cancelar</a>
                        <button
                            type="submit"
                            class="btn btn-success toUpperCase">Salvar</button>
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
            const fisicaInputs = document.querySelectorAll('.fisica-input');
            const juridicaInputs = document.querySelectorAll('.juridica-input');

            if (tipoPessoa === 'F') {
                fisicaFields.forEach(field => field.style.display = 'block');
                juridicaFields.forEach(field => field.style.display = 'none');

                fisicaInputs.forEach(input => input.disabled = false);
                juridicaInputs.forEach(input => input.disabled = true);
            } else {
                fisicaFields.forEach(field => field.style.display = 'none');
                juridicaFields.forEach(field => field.style.display = 'block');

                fisicaInputs.forEach(input => input.disabled = true);
                juridicaInputs.forEach(input => input.disabled = false);
            }

        }

        // Inicializa os campos com base na seleção atual
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script>
@endsection
