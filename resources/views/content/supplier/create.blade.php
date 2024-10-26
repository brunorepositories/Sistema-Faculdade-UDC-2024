@extends('layouts/contentNavbarLayout')

@section('title', 'Novo Fornecedor')

@section('content')
    <div class="card mb-10">
        <h4 class="card-header">Novo Fornecedor</h4>

        <div class="card-body">

            @include('components.errorMessage')

            <form
                class="needs-validation row @if ($errors->any()) was-validated @endif"
                action="{{ route('supplier.store') }}"
                method="POST"
                novalidate>

                @csrf

                <div class="col-md-2 mb-3">
                    <label class="form-label" for="tipoPessoa">Tipo de Pessoa</label>
                    <select
                        required
                        name="tipoPessoa"
                        class="form-select"
                        id="tipoPessoa">
                        <option value="" disabled selected>Selecione</option>
                        <option value="F">Jurídica</option>
                        <option value="J">Física</option>
                    </select>
                    @error('tipoPessoa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-5 mb-3">
                    <label class="form-label" for="fornecedorRazaoSocial">Razão Social</label>
                    <input
                        required
                        name="fornecedorRazaoSocial"
                        type="text"
                        class="form-control"
                        id="fornecedorRazaoSocial"
                        placeholder="Informe a razão social"
                        maxlength="100"
                        value="{{ old('fornecedorRazaoSocial') }}">
                    @error('fornecedorRazaoSocial')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-5 mb-3">
                    <label class="form-label" for="apelidoNomeFantasia">Nome Fantasia</label>
                    <input
                        name="apelidoNomeFantasia"
                        type="text"
                        class="form-control"
                        id="apelidoNomeFantasia"
                        placeholder="Informe o nome fantasia"
                        maxlength="100"
                        value="{{ old('apelidoNomeFantasia') }}">
                    @error('apelidoNomeFantasia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label" for="dataNasc">Data de Nascimento</label>
                    <input
                        name="dataNasc"
                        type="date"
                        class="form-control"
                        id="dataNasc"
                        value="{{ old('dataNasc') }}">
                    @error('dataNasc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label" for="sexo">Sexo</label>
                    <select name="sexo" class="form-select" id="sexo">
                        <option value="" disabled selected>Selecione</option>
                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Feminino</option>
                    </select>
                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="col-md-4 mb-3">
                    <label class="form-label" for="cpf">CPF</label>
                    <input
                        name="cpf"
                        type="text"
                        class="form-control"
                        id="cpf"
                        placeholder="Informe o CPF"
                        value="{{ old('cpf') }}">
                    @error('cpf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="cnpj">CNPJ</label>
                    <input
                        name="cnpj"
                        type="text"
                        class="form-control"
                        id="cnpj"
                        placeholder="Informe o CNPJ"
                        value="{{ old('cnpj') }}">
                    @error('cnpj')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="ie">Inscrição Estadual</label>
                    <input
                        name="ie"
                        type="text"
                        class="form-control"
                        id="ie"
                        placeholder="Informe a inscrição estadual"
                        value="{{ old('ie') }}">
                    @error('ie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="rg">RG</label>
                    <input
                        name="rg"
                        type="text"
                        class="form-control"
                        id="rg"
                        placeholder="Informe o RG"
                        value="{{ old('rg') }}">
                    @error('rg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-4 mb-4">
                    <h5>Contato</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nomeContato">Nome do Contato</label>
                    <input
                        name="nomeContato"
                        type="text"
                        class="form-control"
                        id="nomeContato"
                        placeholder="Informe o nome do contato"
                        value="{{ old('nomeContato') }}">
                    @error('nomeContato')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input
                        name="email"
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="Informe o email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="usuario">Usuário</label>
                    <input
                        name="usuario"
                        type="text"
                        class="form-control"
                        id="usuario"
                        placeholder="Informe o usuário"
                        value="{{ old('usuario') }}">
                    @error('usuario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="telefone">Telefone</label>
                    <input
                        name="telefone"
                        type="text"
                        class="form-control"
                        id="telefone"
                        placeholder="Informe o telefone"
                        value="{{ old('telefone') }}">
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="celular">Celular</label>
                    <input
                        name="celular"
                        type="text"
                        class="form-control"
                        id="celular"
                        placeholder="Informe o celular"
                        value="{{ old('celular') }}">
                    @error('celular')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="ativo">Ativo</label>
                    <select name="ativo" class="form-select" id="ativo">
                        <option value="1" {{ old('ativo', true) ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ old('ativo') === false ? 'selected' : '' }}>Não</option>
                    </select>
                    @error('ativo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="city_id">Cidade</label>
                    <select
                        required
                        name="city_id"
                        class="form-select"
                        id="city_id">
                        <option value="" disabled selected>Selecione uma cidade</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="payment_term_id">Termo de Pagamento</label>
                    <select
                        required
                        name="payment_term_id"
                        class="form-select"
                        id="payment_term_id">
                        <option value="" disabled selected>Selecione um termo</option>
                        @foreach ($paymentTerms as $term)
                            <option value="{{ $term->id }}"
                                {{ old('payment_term_id') == $term->id ? 'selected' : '' }}>{{ $term->name }}</option>
                        @endforeach
                    </select>
                    @error('payment_term_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-12 mt-4 mb-4">
                    <h5>Endereço</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="endereco">Endereço</label>
                    <input
                        required
                        name="endereco"
                        type="text"
                        class="form-control"
                        id="endereco"
                        placeholder="Informe o endereço"
                        value="{{ old('endereco') }}">
                    @error('endereco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="numero">Número</label>
                    <input
                        required
                        name="numero"
                        type="text"
                        class="form-control"
                        id="numero"
                        placeholder="Informe o número"
                        value="{{ old('numero') }}">
                    @error('numero')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="bairro">Bairro</label>
                    <input
                        required
                        name="bairro"
                        type="text"
                        class="form-control"
                        id="bairro"
                        placeholder="Informe o bairro"
                        value="{{ old('bairro') }}">
                    @error('bairro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="cep">CEP</label>
                    <input
                        required
                        name="cep"
                        type="text"
                        class="form-control"
                        id="cep"
                        placeholder="Informe o CEP"
                        value="{{ old('cep') }}">
                    @error('cep')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="complemento">Complemento</label>
                    <input
                        name="complemento"
                        type="text"
                        class="form-control"
                        id="complemento"
                        placeholder="Informe o complemento"
                        value="{{ old('complemento') }}">
                    @error('complemento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="d-flex justify-content-end mt-10">
                    <a
                        href="{{ route('supplier.index') }}"
                        class="btn btn-outline-secondary me-4">Cancelar</a>
                    <button
                        type="submit"
                        class="btn btn-success">Cadastrar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
