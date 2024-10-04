@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <div class="card mb-10">
        <h5 class="card-header">Cadastrar novo produto</h5>
        <div class="card-body">
            <form class="needs-validation " action="{{ route('products.store') }}" novalidate="" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="form-label" for="nome">Nome do produto</label>
                    <input name="nome" type="text" required class="form-control" id="nome"
                        placeholder="Informe o nome" maxlength="50">
                    <div class="invalid-feedback">Campo obrigatório</div>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="unidade">Unidade</label>
                    <input name="unidade" type="text" required class="form-control" id="unidade"
                        placeholder="Informe a unidade" maxlength="50">
                    <div class="invalid-feedback">Campo obrigatório</div>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="estoque">Estoque</label>
                    <input name="estoque" type="number" required class="form-control" id="estoque"
                        placeholder="Informe o estoque">
                    <div class="invalid-feedback">Campo obrigatório</div>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="preco_custo">Preço de custo</label>
                    <input name="preco_custo" type="number" step="0.01" required class="form-control" id="preco_custo"
                        placeholder="Informe o preço de custo">
                    <div class="invalid-feedback">Campo obrigatório</div>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="custo_ultima_compra">Custo da última compra</label>
                    <input name="custo_ultima_compra" type="number" step="0.01" class="form-control"
                        id="custo_ultima_compra" placeholder="Informe o custo da última compra">
                </div>

                <div class="mb-6">
                    <label class="form-label" for="dt_ultima_compra">Data da última compra</label>
                    <input name="dt_ultima_compra" type="datetime-local" class="form-control" id="dt_ultima_compra">
                </div>

                <div class="mb-6">
                    <label class="form-label" for="preco_venda">Preço de venda</label>
                    <input name="preco_venda" type="number" step="0.01" required class="form-control" id="preco_venda"
                        placeholder="Informe o preço de venda">
                    <div class="invalid-feedback">Campo obrigatório</div>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="preco_ultima_venda">Preço da última venda</label>
                    <input name="preco_ultima_venda" type="number" step="0.01" class="form-control"
                        id="preco_ultima_venda" placeholder="Informe o preço da última venda">
                </div>

                <div class="mb-6">
                    <label class="form-label" for="dt_ultima_venda">Data da última venda</label>
                    <input name="dt_ultima_venda" type="datetime-local" class="form-control" id="dt_ultima_venda">
                </div>

                {{-- Campos apenas para visualização --}}
                <div class="mb-6">
                    <label class="form-label" for="dt_cadastro">Data de cadastro</label>
                    <input name="dt_cadastro" type="datetime-local" class="form-control" id="dt_cadastro" readonly>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="dt_alteracao">Data da última alteração</label>
                    <input name="dt_alteracao" type="datetime-local" class="form-control" id="dt_alteracao" readonly>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
